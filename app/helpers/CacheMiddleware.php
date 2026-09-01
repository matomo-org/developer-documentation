<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

/**
 * Class CacheMiddleware.
 *
 * Only GET requests are cached so far and only by path. So if you request a URL like "/foo" and URL like "/foo?bar=1"
 * the same cache key is used.
 *
 * @package helpers
 */
class CacheMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {

        if ($this->shouldCache($request)) {
            $content = Cache::get($this->getCacheKey($request));
            $response = new Response();
            if (!empty($content)) {
                if ($this->isJsonData($request)) {
                    $response = $response->withHeader('Content-Type', 'application/json');
                    $response->getBody()->write($content);
                } else {
                    $response = $response->withHeader('Content-Type', 'text/html; charset=UTF-8');
                    $response->getBody()->write($content . "\n<!-- Cached response -->");
                }
                return $response->withHeader('X-Content-Type-Options', 'nosniff');
            }
        }

        $response = $handler->handle($request);
        $content = $response->getBody();
        if ($this->shouldCache($request) && 200 == $response->getStatusCode()
            && $this->isCacheableResponse($response) && !$this->hadIncludeFileError($content)) {
            Cache::set($this->getCacheKey($request), $content);
        }
        return $response;
    }

    /**
     * We currently ignore query parameters...
     *
     * @param $path
     * @return mixed|string
     */
    private function pathToCacheKey($path)
    {
        if ('/' == $path || empty($path)) {
            return 'index';
        }

        $path = strip_tags($path);
        $path = trim($path);
        $path = preg_replace('/\//', '-', $path);
        $path = preg_replace('/\s/', '-', $path);
        $path = preg_replace('/[^a-zA-Z0-9\-]/', '', $path);
        $path = strtolower($path);

        return $path;
    }

    /**
     * Only the response body is stored, and the cache key is built from the path
     * without any request header, so a response is stored only when it can be replayed
     * unchanged to every later request for the same path.
     *
     * @param Response $response
     * @return bool
     */
    private function isCacheableResponse($response)
    {
        $directives = $this->getCacheControlDirectives($response);

        foreach (['no-store', 'no-cache', 'private'] as $directive) {
            if (in_array($directive, $directives, true)) {
                return false;
            }
        }

        if ('' !== trim($response->getHeaderLine('Vary'))) {
            return false;
        }

        return !$response->hasHeader('Set-Cookie');
    }

    /**
     * Returns the lower cased Cache-Control directive names, without their arguments.
     *
     * @param Response $response
     * @return array
     */
    private function getCacheControlDirectives($response)
    {
        $directives = [];

        foreach (explode(',', strtolower($response->getHeaderLine('Cache-Control'))) as $directive) {
            $nameAndArgument = explode('=', $directive, 2);
            $directives[] = trim($nameAndArgument[0]);
        }

        return $directives;
    }

    private function hadIncludeFileError($content)
    {
        return strpos($content, "Error while retrieving") !== false;
    }

    private function isJsonData(Request $req)
    {
        return substr($req->getUri()->getPath(), 0, 6) === '/data/';
    }


    private function shouldCache(Request $req)
    {
        if ($req->getMethod() !== "GET") {
            return false;
        }

        return strpos($req->getUri()->getPath(), '/demo/') !== 0;
    }

    private function getCacheKey(Request $req)
    {
        $piwikVersion = Environment::getPiwikVersion();


        if ($this->isJsonData($req)) {
            $type = "json";
        } else {
            $type = "html";
        }

        return $piwikVersion . '_' . $this->pathToCacheKey($req->getUri()->getPath()) . "." . $type;
    }
}
