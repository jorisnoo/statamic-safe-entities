# Statamic Safe Entities

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jorisnoo/statamic-safe-entities.svg?style=flat-square)](https://packagist.org/packages/jorisnoo/statamic-safe-entities)
[![Tests](https://github.com/jorisnoo/statamic-safe-entities/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/jorisnoo/statamic-safe-entities/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/jorisnoo/statamic-safe-entities.svg?style=flat-square)](https://packagist.org/packages/jorisnoo/statamic-safe-entities)

A Statamic addon for safe HTML entity insertion in Bard, text, and textarea fields. Adds a Bard toolbar button for inserting soft hyphens, non-breaking spaces, en dashes, and other typography entities, plus Blade directives to render them safely.

## Installation

Requires Statamic 6 and PHP 8.2 or later.

```bash
composer require jorisnoo/statamic-safe-entities
```

## Configuration

Publish the config file to customize which entities are available:

```bash
php artisan vendor:publish --tag="safe-entities-config"
```

Default configuration:

```php
return [
    'entities' => ['&shy;', '&nbsp;', '&ndash;'],
    'replacements' => [],
];
```

An indexed code uses the editor's translated label (or the code itself). To override it, use `'&nbsp;' => 'Fixed space'`. To insert a shorthand with a different rendered output, use `'&nnbsp;' => ['output' => '&#8239;', 'label' => 'Narrow space']`.

`replacements` maps literal search strings to their output **after** escaping and entity restoration. For example, `'&lt;br&gt;' => '<br>'` converts a typed `<br>` in a plain text field to a line break. Replacement output is not escaped: use only trusted rules, and do not use markup-producing replacements with visitor input. Editors can see the configured patterns in **Utilities → Special Characters**.

## Usage

### Bard toolbar

Add the following button names to the field's existing Bard `buttons` list:

```yaml
buttons:
  - bold
  - safeentities
  - entityvisibility
```

The **&** dropdown inserts a literal code at the cursor. The **eye** switches between codes and rendered characters without changing the stored content.

### Blade directives

Two Blade directives are available for rendering entities safely:

#### `@entities($text)` — for text/textarea fields

Escapes the string for safe HTML output, then restores configured entity codes so they render as actual entities.

```blade
<p>@entities($entry->title)</p>
```

#### `@entitiesHtml($html)` — for Bard/rich-text fields

Restores double-encoded entities (`&amp;shy;` back to `&shy;`) in trusted, already-rendered HTML. It does **not** sanitize HTML. For a Bard field **without sets**, the augmented value is an HTML string:

```blade
<div>@entitiesHtml($entry->content)</div>
```

A Bard field **with sets** yields a list of chunks instead. Pass only a text chunk's HTML to the directive; render each other set with its own template:

```blade
@foreach ($entry->content as $set)
    @if ($set->type === 'text')
        @entitiesHtml($set->text)
    @else
        @include('sets.'.$set->type, ['set' => $set])
    @endif
@endforeach
```

### PHP

You can also call the methods directly:

```php
use Noo\SafeEntities\SafeEntities;

$text = SafeEntities::render($value);
$html = SafeEntities::renderHtml($value);
```

Both methods accept an optional second argument to override which entities to restore:

```php
SafeEntities::render($value, ['&shy;', '&nbsp;']);
```

## Testing

```bash
composer install
vendor/bin/phpunit
npm ci
npm test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Joris Noordermeer](https://github.com/jorisnoo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see the [license file](LICENSE.md) for more information.

## Maintainer releases

See [RELEASING.md](RELEASING.md) for versioning, changelog entries and the release command.
