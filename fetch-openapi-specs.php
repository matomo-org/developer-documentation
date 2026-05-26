<?php

declare(strict_types=1);

$baseUrl = rtrim(getenv('MATOMO_BASE_URL') ?: 'https://demo.matomo.cloud/', '/');
$tokenAuth = getenv('MATOMO_TOKEN_AUTH') ?: 'anonymous';
$targetDirectory = __DIR__ . '/app/public/openapi';
$metadataPath = $targetDirectory . '/plugin_metadata_v1.0.0.json';
$version = '1.0.0';
$excludedPlugins = [
    'LogViewer',
    'TreemapVisualization',
    'GithubAnalytics',
    'LoginLdap',
    'CustomTranslations',
];

if (!is_dir($targetDirectory)) {
    fwrite(STDERR, "Target directory does not exist: $targetDirectory\n");
    exit(1);
}

if (!function_exists('curl_init')) {
    fwrite(STDERR, "The curl extension is required to fetch OpenAPI specs.\n");
    exit(1);
}

function buildRequestUrl(string $baseUrl, array $params): string
{
    return $baseUrl . '/index.php?' . http_build_query($params);
}

function describeRequest(string $baseUrl, array $params): string
{
    $descriptionParams = $params;
    unset($descriptionParams['token_auth']);

    return buildRequestUrl($baseUrl, $descriptionParams);
}

/**
 * @return list<string>
 */
function findExistingSpecFiles(string $targetDirectory): array
{
    $files = glob($targetDirectory . '/*_openapi_spec_v*.json');
    if ($files === false) {
        throw new RuntimeException("Failed to list existing OpenAPI spec files in $targetDirectory");
    }

    return array_values($files);
}

function removeStaleSpecFiles(string $targetDirectory, array $expectedPaths): void
{
    $expectedPaths = array_fill_keys($expectedPaths, true);

    foreach (findExistingSpecFiles($targetDirectory) as $existingPath) {
        if (isset($expectedPaths[$existingPath])) {
            continue;
        }

        if (!unlink($existingPath)) {
            throw new RuntimeException("Failed to remove stale file: $existingPath");
        }
    }
}

function getSpecPath(string $targetDirectory, string $plugin, string $version): string
{
    return sprintf('%s/%s_openapi_spec_v%s.json', $targetDirectory, $plugin, $version);
}

function writeJsonFile(string $path, array $data, string $errorContext): void
{
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if ($json === false) {
        throw new RuntimeException("Failed to encode JSON for $errorContext");
    }

    $json .= "\n";
    $directory = dirname($path);
    $tempPath = tempnam($directory, 'openapi_');
    if ($tempPath === false) {
        throw new RuntimeException("Failed to create temporary file for $errorContext");
    }

    if (file_put_contents($tempPath, $json) === false) {
        @unlink($tempPath);
        throw new RuntimeException("Failed to write file: $path");
    }

    if (!rename($tempPath, $path)) {
        @unlink($tempPath);
        throw new RuntimeException("Failed to move temporary file into place: $path");
    }
}

function fetchJson(string $baseUrl, string $tokenAuth, array $params): array
{
    $params['module'] = 'API';
    $params['format'] = 'JSON';
    $params['token_auth'] = $tokenAuth;

    $url = buildRequestUrl($baseUrl, $params);
    $requestDescription = describeRequest($baseUrl, $params);
    $ch = curl_init($url);
    if ($ch === false) {
        throw new RuntimeException("Failed to initialize curl for $requestDescription");
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
        throw new RuntimeException("Request failed for $requestDescription: $error");
    }

    $statusCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    curl_close($ch);

    if ($statusCode < 200 || $statusCode >= 300) {
        throw new RuntimeException("Request failed for $requestDescription with HTTP status $statusCode");
    }

    $decoded = json_decode($response, true);
    if (!is_array($decoded)) {
        throw new RuntimeException("Invalid JSON response for $requestDescription");
    }

    if (isset($decoded['result']) && $decoded['result'] === 'error') {
        $message = is_string($decoded['message'] ?? null) ? $decoded['message'] : 'Unknown API error';
        throw new RuntimeException($message);
    }

    return $decoded;
}

try {
    $plugins = fetchJson($baseUrl, $tokenAuth, [
        'method' => 'ApiReference.getAllowedPlugins',
    ]);
} catch (Throwable $e) {
    fwrite(STDERR, "Failed to fetch plugin whitelist: {$e->getMessage()}\n");
    exit(1);
}

try {
    $pluginMetadata = fetchJson($baseUrl, $tokenAuth, [
        'method' => 'ApiReference.getAllowedPluginMetadata',
    ]);
} catch (Throwable $e) {
    fwrite(STDERR, "Failed to fetch plugin metadata: {$e->getMessage()}\n");
    exit(1);
}

$written = 0;
$expectedPaths = [];
$excludedPlugins = array_fill_keys($excludedPlugins, true);

foreach ($plugins as $plugin) {
    if (!is_string($plugin) || $plugin === '') {
        continue;
    }

    if (isset($excludedPlugins[$plugin])) {
        $existingPath = getSpecPath($targetDirectory, $plugin, $version);
        if (is_file($existingPath)) {
            $expectedPaths[] = $existingPath;
        }

        continue;
    }

    try {
        $spec = fetchJson($baseUrl, $tokenAuth, [
            'method' => 'ApiReference.getGeneratedOpenApiSpec',
            'plugin' => $plugin,
        ]);

        $path = getSpecPath($targetDirectory, $plugin, $version);
        $expectedPaths[] = $path;
        writeJsonFile($path, $spec, "plugin $plugin");

        $written++;
    } catch (Throwable $e) {
        fwrite(STDERR, "Failed for $plugin: {$e->getMessage()}\n");
        exit(1);
    }
}

try {
    removeStaleSpecFiles($targetDirectory, $expectedPaths);
} catch (Throwable $e) {
    fwrite(STDERR, "Failed to clean up stale spec files: {$e->getMessage()}\n");
    exit(1);
}

try {
    writeJsonFile($metadataPath, $pluginMetadata, 'plugin metadata');
} catch (Throwable $e) {
    fwrite(STDERR, "Failed to write plugin metadata: {$e->getMessage()}\n");
    exit(1);
}

echo "Wrote $written spec file(s) to $targetDirectory\n";
