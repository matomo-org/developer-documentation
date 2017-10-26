<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

use Slim\Http\Response;
use Slim\Http\Request;

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
    public function __invoke(Request $req, Response $res, callable $next) {

        if ($this->shouldCache($req)) {
            $content = Cache::get($this->getCacheKey($req));

            if (!empty($content)) {
                $res->getBody()->write($content . "\n<!-- Cached respones -->");
                return $res;
            }
        }
        /** @var Response $res */
        $res = $next($req, $res);

        if ($this->shouldCache($req) && 200 == $res->getStatusCode()) {
            $res->getBody()->rewind();
//            var_dump($res->getBody()->getContents());
            Cache::set($this->getCacheKey($req), $res->getBody()->getContents());
        }

        return $res;
    }

    /**
     * We currently ignore query parameters...
     *
     * @param $path
     * @return mixed|string
     */
    private function pathToCacheKey($path) {
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

    private function shouldCache(Request $req) {
        return $req->isGet() && strpos($req->getUri()->getPath(), 'data/') === false;
    }

    private function getCacheKey(Request $req) {
        $piwikVersion = Environment::getPiwikVersion();

        return $piwikVersion . '_' . $this->pathToCacheKey($req->getUri()->getPath()) . ".html";
    }
}