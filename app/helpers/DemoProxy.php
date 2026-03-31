<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

/**
 * Proxy for demo.matomo.cloud, allows us to make single origin requests by doing them through this class
 */
class DemoProxy
{

    private const MATOMO_SWAGGER_PROXY_TARGET = 'https://demo.matomo.cloud';
    private const DEMO_AUTHORIZATION_HEADER = 'Bearer anonymous';

    /**
     * Fetches a demo API GET response and returns the body and status code.
     *
     * @param string $url Demo API URL to request.
     * @return array{body: string, statusCode: int}
     */
    public static function get(string $url): array
    {
        $context = self::createContext();
        $proxiedResponse = self::fetchResponse($url, $context);
        $statusCode = self::parseStatusCode($proxiedResponse['responseHeaders']);

        return [
            'body' => $proxiedResponse['body'],
            'statusCode' => $statusCode,
        ];
    }

    /**
     * Builds a validated demo API URL for proxying.
     *
     * @param string $path Relative request path.
     * @param array $queryParams Query parameters to append to the URL.
     * @return string The validated absolute demo API URL.
     * @throws \InvalidArgumentException If the path is not index.php.
     * @throws \InvalidArgumentException If the module query parameter is not API.
     */
    public static function buildValidatedApiUrl(string $path, array $queryParams): string
    {
        $normalizedPath = trim($path, '/');
        if ($normalizedPath !== 'index.php') {
            throw new \InvalidArgumentException('Path must be index.php');
        }

        if (($queryParams['module'] ?? null) !== 'API') {
            throw new \InvalidArgumentException('Module must be API');
        }

        $targetUrl = rtrim(self::MATOMO_SWAGGER_PROXY_TARGET, '/') . '/' . $normalizedPath;
        $query = http_build_query($queryParams);

        if ($query !== '') {
            $targetUrl .= '?' . $query;
        }

        return $targetUrl;
    }

    private static function createContext()
    {
        return stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => self::buildHeaders(),
                'ignore_errors' => true,
                'timeout' => 30,
            ],
        ]);
    }

    private static function buildHeaders(): string
    {
        return 'Authorization: ' . self::DEMO_AUTHORIZATION_HEADER;
    }

    /**
     * @return array{body: string, responseHeaders: array}
     */
    private static function fetchResponse(string $url, $context): array
    {
        $body = @file_get_contents($url, false, $context);
        if ($body === false) {
            throw new \RuntimeException('Could not proxy HTTP request');
        }

        return [
            'body' => $body,
            'responseHeaders' => $http_response_header ?? [],
        ];
    }

    private static function parseStatusCode(array $responseHeaders): int
    {
        $statusLine = $responseHeaders[0] ?? '';

        if (preg_match('#^HTTP/\S+\s+(\d{3})#', $statusLine, $matches)) {
            return (int) $matches[1];
        }

        return 200;
    }
}
