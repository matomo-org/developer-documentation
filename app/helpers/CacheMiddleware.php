<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

/**
 * Class CacheMiddleware.
 *
 * Only GET requests are cached so far and only by path. So if you request a URL like "/foo" and URL like "/foo?bar=1"
 * the same cache key is used.
 *
 * @package helpers
 */
class CacheMiddleware extends \Slim\Middleware
{
    public function call()
    {
        $app = $this->app;

        /**
         * @var $req \Slim\Http\Request
         */
        $req = $app->request;

        /**
         * @var $res \Slim\Http\Response
         */
        $res  = $app->response;
        $cacheKey = $this->pathToCacheKey($req->getPath());

        if ($req->isGet()) {
            $content = Cache::get($cacheKey);

            if (!empty($content)) {
                $res->setBody($content);

                return;
            }
        }

        $this->next->call();

        if ($req->isGet()) {
            Cache::set($cacheKey, $res->getBody());
        }
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
        $path = preg_replace('/\s/', '-', $path);
        $path = preg_replace('/[^a-zA-Z0-9\-]/', '', $path);
        $path = strtolower($path);

        return $path;
    }
}