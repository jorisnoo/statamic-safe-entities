<?php

namespace Noo\SafeEntities;

use Illuminate\Support\HtmlString;

class SafeEntities
{
    /**
     * Escape a string for safe HTML output, then restore configured entities
     * and apply configured replacements.
     *
     * For plain text/textarea fields rendered with @entities().
     *
     * @param  array<string, string|array>|array<int, string>|null  $entities
     * @param  array<string, string>|null  $replacements
     */
    public static function render(?string $value, ?array $entities = null, ?array $replacements = null): HtmlString
    {
        if ($value === null || $value === '') {
            return new HtmlString('');
        }

        $escaped = e($value);
        $result = self::restoreEntities($escaped, $entities);
        $result = self::applyReplacements($result, $replacements);

        return new HtmlString($result);
    }

    /**
     * Restore configured entities and apply replacements in already-rendered HTML.
     *
     * For Bard/rich-text fields where entities are stored as literal codes
     * (e.g. &amp;shy;) and need to be converted back to working entities.
     *
     * @param  array<string, string|array>|array<int, string>|null  $entities
     * @param  array<string, string>|null  $replacements
     */
    public static function renderHtml(?string $value, ?array $entities = null, ?array $replacements = null): HtmlString
    {
        if ($value === null || $value === '') {
            return new HtmlString('');
        }

        $result = self::restoreEntities($value, $entities);
        $result = self::applyReplacements($result, $replacements);

        return new HtmlString($result);
    }

    /**
     * Replace double-encoded entities (&amp;shy;) with their working form (&shy;).
     * Supports aliased entities where the output differs from the input code
     * (e.g. &nnbsp; → &#8239;).
     *
     * @param  array<string, string|array>|array<int, string>|null  $entities
     */
    private static function restoreEntities(string $value, ?array $entities = null): string
    {
        $entities ??= config('statamic.safe-entities.entities', []);
        $map = self::entityMap($entities);

        foreach ($map as $input => $output) {
            $doubleEncoded = str_replace('&', '&amp;', $input);
            $value = str_replace($doubleEncoded, $output, $value);
        }

        return $value;
    }

    /**
     * Apply configured string replacements.
     *
     * @param  array<string, string>|null  $replacements
     */
    private static function applyReplacements(string $value, ?array $replacements = null): string
    {
        $replacements ??= config('statamic.safe-entities.replacements', []);

        if (empty($replacements)) {
            return $value;
        }

        return str_replace(array_keys($replacements), array_values($replacements), $value);
    }

    /**
     * Build a map of [inputCode => outputCode] from the entities config.
     *
     * Supports these formats:
     * - Indexed: ['&shy;', '&nbsp;']
     * - Keyed with string label: ['&shy;' => 'Soft Hyphen'] (label ignored here)
     * - Keyed with alias: ['&nnbsp;' => ['output' => '&#8239;']]
     *
     * @return array<string, string>
     */
    private static function entityMap(array $entities): array
    {
        $map = [];

        foreach ($entities as $code => $value) {
            if (is_int($code)) {
                $map[$value] = $value;
            } elseif (is_array($value) && isset($value['output'])) {
                $map[$code] = $value['output'];
            } else {
                $map[$code] = $code;
            }
        }

        return $map;
    }
}
