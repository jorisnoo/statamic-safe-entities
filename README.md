# Statamic Safe Entities

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jorisnoo/statamic-safe-entities.svg?style=flat-square)](https://packagist.org/packages/jorisnoo/statamic-safe-entities)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jorisnoo/statamic-safe-entities/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jorisnoo/statamic-safe-entities/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jorisnoo/statamic-safe-entities/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/jorisnoo/statamic-safe-entities/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jorisnoo/statamic-safe-entities.svg?style=flat-square)](https://packagist.org/packages/jorisnoo/statamic-safe-entities)

A Statamic addon for safe HTML entity insertion in Bard, text, and textarea fields. Adds a Bard toolbar button for inserting soft hyphens, non-breaking spaces, en dashes, and other typography entities, plus Blade directives to render them safely.

## Installation

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
    'entities' => [
        '&shy;' => 'Soft Hyphen',
        '&nbsp;' => 'Non-Breaking Space',
        '&ndash;' => 'En Dash',
    ],
];
```

Each entry maps an entity code to a label shown in the Bard toolbar dropdown.

## Usage

### Bard toolbar

The addon adds an "&" button to the Bard toolbar. Clicking it shows a dropdown of configured entities. Selecting one inserts the entity code at the cursor position.

### Blade directives

Two Blade directives are available for rendering entities safely:

#### `@entities($text)` — for text/textarea fields

Escapes the string for safe HTML output, then restores configured entity codes so they render as actual entities.

```blade
<p>@entities($entry->title)</p>
```

#### `@entitiesHtml($html)` — for Bard/rich-text fields

Restores double-encoded entities (`&amp;shy;` back to `&shy;`) in already-rendered HTML.

```blade
<div>@entitiesHtml($entry->content)</div>
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
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Joris Noordermeer](https://github.com/jorisnoo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
