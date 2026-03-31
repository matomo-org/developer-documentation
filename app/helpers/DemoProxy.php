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

    public const MATOMO_SWAGGER_PROXY_TARGET = 'https://demo.matomo.cloud';

    /**
     * Fetches a demo API GET response and returns the body and status code.
     *
     * @param string $url Demo API URL to request.
     * @param string $authorizationHeader Optional Authorization header value to forward.
     * @return array{body: string, statusCode: int}
     */
    public static function get(string $url, string $authorizationHeader = ''): array
    {
        $context = self::createContext($authorizationHeader);
        $proxiedResponse = self::fetchResponse($url, $context);
        $statusCode = self::parseStatusCode($proxiedResponse['responseHeaders']);

        return [
            'body' => $proxiedResponse['body'],
            'statusCode' => $statusCode,
        ];
    }

    private static function createContext(string $authorizationHeader)
    {
        return stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => self::buildHeaders($authorizationHeader),
                'ignore_errors' => true,
                'timeout' => 30,
            ],
        ]);
    }

    private static function buildHeaders(string $authorizationHeader): string
    {
        if ($authorizationHeader === '') {
            return '';
        }

        return 'Authorization: ' . $authorizationHeader;
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
