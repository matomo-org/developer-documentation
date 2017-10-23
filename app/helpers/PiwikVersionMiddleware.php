<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CacheMiddleware.
 *
 * Only GET requests are cached so far and only by path. So if you request a URL like "/foo" and URL like "/foo?bar=1"
 * the same cache key is used.
 *
 * @package helpers
 */
class PiwikVersionMiddleware
{
    public function __invoke(Request $req, Response $res, callable $next) {
        $uri = $req->getUri();
        $path = $uri->getPath();
        // we match eg /2.x or /3.x /19.x and remove it from the path so our routes in routes/page.php still match.
        // Instead of changing the path I wanted to add a group around all routes in page but slim 2 doesn't allow us to define
        // a condition on a group route unfortunately
        $matches = array();

        if ($this->hasPiwikVersionInUrl($path, $matches)) {
            if ($this->isValidPiwikVersionAndAllowedToBeInPath($matches[1])) {
                // we only allow usage of 2.x or 3.x for outdated Piwik versions. Latest will be always
                // available only under "/" whereas older versions will be /2.x . Once Piwik 4 is available,
                // it will automatically work for '/2.x' and '/3.x', we only need to increase LATEST_PIWIK_DOCS_VERSION
                // in the config
                Environment::setPiwikVersion($matches[1]);
                $uri = $uri->withPath($this->removePiwikVersionFromCurrentPath($path, $matches[1]));
                $req = $req->withUri($uri);
            }
        }
        return $next($req, $res);
    }

    private function removePiwikVersionFromCurrentPath($path, $piwikVersion) {
        return substr($path, strlen('/' . $piwikVersion . '.x'));
    }

    private function hasPiwikVersionInUrl($path, &$matches) {
        return preg_match('/\/(\d)+\.x(\/)?/', $path, $matches);
    }

    private function isValidPiwikVersionAndAllowedToBeInPath($piwikVersion) {
        return $piwikVersion < LATEST_PIWIK_DOCS_VERSION;
    }
}