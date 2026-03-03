<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class MatomoVersionMiddleware
{

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $uri = $request->getUri();
        $path = $uri->getPath();
        // we match eg /2.x or /3.x /19.x and remove it from the path so our routes in routes/page.php still match.
        // Instead of changing the path I wanted to add a group around all routes in page but slim 2 doesn't allow us to define
        // a condition on a group route unfortunately

        $matomoVersion = self::getMatmoVersionFromUrl($path);

        if (!empty($matomoVersion)) {
            // we only allow usage of 2.x or 3.x for outdated Piwik versions. Latest will be always
            // available only under "/" whereas older versions will be /2.x . Once Piwik 4 is available,
            // it will automatically work for '/2.x' and '/3.x', we only need to increase LATEST_PIWIK_DOCS_VERSION
            // in the config
            Environment::setPiwikVersion($matomoVersion); // the piwik version should be already set but setting it anyway again
            $uri = $uri->withPath($this->removePiwikVersionFromCurrentPath($path, $matomoVersion));
            $request = $request->withUri($uri);
        }
        $response = $handler->handle($request);

        return $response;
    }

    public static function getMatmoVersionFromUrl($path)
    {
        if (self::hasPiwikVersionInUrl($path, $matches)) {
            $maotmoVersionNumber = (int) $matches[1];
            if (self::isValidPiwikVersionAndAllowedToBeInPath($maotmoVersionNumber)) {
                return $maotmoVersionNumber;
            }
        }
    }

    private function removePiwikVersionFromCurrentPath($path, $piwikVersion)
    {
        return substr($path, strlen('/' . $piwikVersion . '.x'));
    }

    private static function hasPiwikVersionInUrl($path, &$matches)
    {
        return preg_match('/\/(\d)+\.x(\/)?/', $path, $matches);
    }

    private static function isValidPiwikVersionAndAllowedToBeInPath($piwikVersion)
    {
        return $piwikVersion >= MIN_PIWIK_DOCS_VERSION && $piwikVersion < LATEST_PIWIK_DOCS_VERSION;
    }
}
