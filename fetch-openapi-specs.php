<?php

declare(strict_types=1);

$baseUrl = rtrim(getenv('MATOMO_BASE_URL') ?: 'https://demo.matomo.cloud/', '/');
$tokenAuth = getenv('MATOMO_TOKEN_AUTH') ?: 'anonymous';
$targetDirectory = __DIR__ . '/app/public/openapi';
$version = '1.0.0';

if (!is_dir($targetDirectory)) {
    fwrite(STDERR, "Target directory does not exist: $targetDirectory\n");
    exit(1);
}

if (!function_exists('curl_init')) {
    fwrite(STDERR, "The curl extension is required to fetch OpenAPI specs.\n");
    exit(1);
}

function fetchJson(string $baseUrl, string $tokenAuth, array $params): array
{
    $params['module'] = 'API';
    $params['format'] = 'JSON';
    $params['token_auth'] = $tokenAuth;

    $url = $baseUrl . '/index.php?' . http_build_query($params);
    $ch = curl_init($url);
    if ($ch === false) {
        throw new RuntimeException("Failed to initialize curl for $url");
    }

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_TIMEOUT => 60,
    ]);

    $response = curl_exec($ch);
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        throw new RuntimeException("Request failed for $url: $error");
    }

    $statusCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);

    if ($statusCode < 200 || $statusCode >= 300) {
        throw new RuntimeException("Request failed for $url with HTTP status $statusCode");
    }

    $decoded = json_decode($response, true);
    if (!is_array($decoded)) {
        throw new RuntimeException("Invalid JSON response: $url");
    }

    if (isset($decoded['result']) && $decoded['result'] === 'error') {
        $message = is_string($decoded['message'] ?? null) ? $decoded['message'] : 'Unknown API error';
        throw new RuntimeException($message);
    }

    return $decoded;
}

try {
    $plugins = fetchJson($baseUrl, $tokenAuth, [
        'method' => 'OpenApiDocs.getPluginWhitelist',
    ]);
} catch (Throwable $e) {
    fwrite(STDERR, "Failed to fetch plugin whitelist: {$e->getMessage()}\n");
    exit(1);
}

$written = 0;

foreach ($plugins as $plugin) {
    if (!is_string($plugin) || $plugin === '') {
        continue;
    }

    try {
        $spec = fetchJson($baseUrl, $tokenAuth, [
            'method' => 'OpenApiDocs.getGeneratedOpenApiSpec',
            'plugin' => $plugin,
        ]);

        $path = sprintf('%s/%s_openapi_spec_v%s.json', $targetDirectory, $plugin, $version);
        $json = json_encode($spec, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            throw new RuntimeException("Failed to encode JSON for plugin $plugin");
        }

        $json .= "\n";
        $tempPath = tempnam($targetDirectory, $plugin . '_openapi_');
        if ($tempPath === false) {
            throw new RuntimeException("Failed to create temporary file for plugin $plugin");
        }

        if (file_put_contents($tempPath, $json) === false) {
            @unlink($tempPath);
            throw new RuntimeException("Failed to write file: $path");
        }

        if (!rename($tempPath, $path)) {
            @unlink($tempPath);
            throw new RuntimeException("Failed to move temporary file into place: $path");
        }

        $written++;
    } catch (Throwable $e) {
        fwrite(STDERR, "Failed for $plugin: {$e->getMessage()}\n");
        exit(1);
    }
}

echo "Wrote $written spec file(s) to $targetDirectory\n";
