<?php

namespace helpers;

/**
 * Discovers plugin OpenAPI spec files exposed by the docs app.
 */
class OpenApiSpecRegistry
{
    /**
     * @return string
     */
    public static function getOpenApiDirectory()
    {
        return __DIR__ . '/../public/openapi';
    }

    /**
     * @return array<int, array{name: string, slug: string, file: string, url: string}>
     */
    public static function getPluginSpecs()
    {
        $files = glob(self::getOpenApiDirectory() . '/*_openapi_spec_v*.json');
        if ($files === false) {
            return [];
        }

        $specs = [];
        foreach ($files as $file) {
            $basename = basename($file);

            if (stripos($basename, 'matomo_') === 0) {
                continue;
            }

            if (!preg_match('/^([A-Za-z0-9]+)_openapi_spec_v[\d.]+\.json$/', $basename, $matches)) {
                continue;
            }

            $name = $matches[1];
            $specs[] = [
                'name' => $name,
                'slug' => self::toSlug($name),
                'file' => $basename,
                'url' => '/openapi/' . $basename,
            ];
        }

        usort($specs, function ($left, $right) {
            return strcasecmp($left['name'], $right['name']);
        });

        return $specs;
    }

    /**
     * @param string $slug
     * @return array{name: string, slug: string, file: string, url: string}|null
     */
    public static function getPluginSpecBySlug($slug)
    {
        foreach (self::getPluginSpecs() as $spec) {
            if ($spec['slug'] === $slug) {
                return $spec;
            }
        }

        return null;
    }

    /**
     * @param string $slug
     * @return array{pluginSpec: array{name: string, slug: string, file: string, url: string}, pluginSpecData: array<mixed>}|null
     */
    public static function getPluginSpecDocumentBySlug($slug)
    {
        $pluginSpec = self::getPluginSpecBySlug($slug);
        if ($pluginSpec === null) {
            return null;
        }

        $pluginSpecPath = self::getSpecFilePath($pluginSpec['file']);
        $pluginSpecContents = @file_get_contents($pluginSpecPath);
        if ($pluginSpecContents === false) {
            return null;
        }

        $pluginSpecData = json_decode($pluginSpecContents, true);
        if (!is_array($pluginSpecData)) {
            throw new \RuntimeException('Invalid OpenAPI spec: ' . $pluginSpec['file']);
        }

        return [
            'pluginSpec' => $pluginSpec,
            'pluginSpecData' => $pluginSpecData,
        ];
    }

    /**
     * @param string $basename
     * @return string
     */
    public static function getSpecFilePath($basename)
    {
        return self::getOpenApiDirectory() . '/' . $basename;
    }

    /**
     * @param string $name
     * @return string
     */
    private static function toSlug($name)
    {
        $slug = preg_replace('/(?<=\\p{Lu})(\\p{Lu}\\p{Ll})/u', '-$1', $name);
        $slug = preg_replace('/(?<=\\p{Ll})(\\p{Lu})/u', '-$1', $slug ?? $name);

        return strtolower($slug ?? $name);
    }
}
