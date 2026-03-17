<?php

namespace Noo\SafeEntities;

use Illuminate\Support\HtmlString;

class SafeEntities
{
    /**
     * Escape a string for safe HTML output, then restore configured entities.
     *
     * For plain text/textarea fields rendered with @entities().
     *
     * @param  array<int, string>|null  $entities
     */
    public static function render(?string $value, ?array $entities = null): HtmlString
    {
        if ($value === null || $value === '') {
            return new HtmlString('');
        }

        $escaped = e($value);

        return new HtmlString(self::restoreEntities($escaped, $entities));
    }

    /**
     * Restore configured entities in already-rendered HTML.
     *
     * For Bard/rich-text fields where entities are stored as literal codes
     * (e.g. &amp;shy;) and need to be converted back to working entities.
     *
     * @param  array<int, string>|null  $entities
     */
    public static function renderHtml(?string $value, ?array $entities = null): HtmlString
    {
        if ($value === null || $value === '') {
            return new HtmlString('');
        }

        return new HtmlString(self::restoreEntities($value, $entities));
    }

    /**
     * Replace double-encoded entities (&amp;shy;) with their working form (&shy;).
     *
     * @param  array<string, string>|array<int, string>|null  $entities
     */
    private static function restoreEntities(string $value, ?array $entities = null): string
    {
        $entities ??= config('statamic.safe-entities.entities', []);
        $codes = self::entityCodes($entities);

        foreach ($codes as $entity) {
            $doubleEncoded = str_replace('&', '&amp;', $entity);
            $value = str_replace($doubleEncoded, $entity, $value);
        }

        return $value;
    }

    /**
     * Extract entity codes from either a keyed (code => label) or indexed array.
     *
     * @return array<int, string>
     */
    private static function entityCodes(array $entities): array
    {
        if (array_is_list($entities)) {
            return $entities;
        }

        return array_keys($entities);
    }
}
