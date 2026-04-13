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

function fetchJson(string $baseUrl, string $tokenAuth, array $params): array
{
    $params['module'] = 'API';
    $params['format'] = 'JSON';
    $params['token_auth'] = $tokenAuth;

    $url = $baseUrl . '/index.php?' . http_build_query($params);
    $response = @file_get_contents($url);

    if ($response === false) {
        throw new RuntimeException("Request failed: $url");
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

        if (file_put_contents($path, $json) === false) {
            throw new RuntimeException("Failed to write file: $path");
        }

        $written++;
    } catch (Throwable $e) {
        fwrite(STDERR, "Failed for $plugin: {$e->getMessage()}\n");
    }
}

echo "Wrote $written spec file(s) to $targetDirectory\n";
