<?php

namespace Noo\SafeEntities\Tests;

use Noo\SafeEntities\SafeEntities;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SafeEntitiesTest extends TestCase
{
    /** @var array<string, string> */
    private array $entities = [
        '&shy;' => 'Soft Hyphen',
        '&nbsp;' => 'Non-Breaking Space',
        '&ndash;' => 'En Dash',
    ];

    #[Test]
    public function render_preserves_soft_hyphens(): void
    {
        $result = SafeEntities::render('Geschäfts&shy;bericht', $this->entities, []);

        $this->assertEquals('Geschäfts&shy;bericht', (string) $result);
    }

    #[Test]
    public function render_preserves_non_breaking_spaces(): void
    {
        $result = SafeEntities::render('10&nbsp;km', $this->entities, []);

        $this->assertEquals('10&nbsp;km', (string) $result);
    }

    #[Test]
    public function render_preserves_en_dashes(): void
    {
        $result = SafeEntities::render('2020&ndash;2024', $this->entities, []);

        $this->assertEquals('2020&ndash;2024', (string) $result);
    }

    #[Test]
    public function render_escapes_html_tags(): void
    {
        $result = SafeEntities::render('<script>alert("xss")</script>', $this->entities, []);

        $this->assertEquals('&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;', (string) $result);
    }

    #[Test]
    public function render_does_not_restore_unlisted_entities(): void
    {
        $result = SafeEntities::render('&amp; &lt; &gt;', $this->entities, []);

        $this->assertEquals('&amp;amp; &amp;lt; &amp;gt;', (string) $result);
    }

    #[Test]
    public function render_handles_null(): void
    {
        $result = SafeEntities::render(null, $this->entities);

        $this->assertEquals('', (string) $result);
    }

    #[Test]
    public function render_handles_empty_string(): void
    {
        $result = SafeEntities::render('', $this->entities);

        $this->assertEquals('', (string) $result);
    }

    #[Test]
    public function render_passes_plain_text_through(): void
    {
        $result = SafeEntities::render('Hello World', $this->entities, []);

        $this->assertEquals('Hello World', (string) $result);
    }

    #[Test]
    public function render_handles_multiple_entities(): void
    {
        $result = SafeEntities::render('Unter&shy;nehmens&shy;beratung&nbsp;GmbH', $this->entities, []);

        $this->assertEquals('Unter&shy;nehmens&shy;beratung&nbsp;GmbH', (string) $result);
    }

    #[Test]
    public function render_uses_custom_entity_list(): void
    {
        $result = SafeEntities::render('10&nbsp;km &shy; test', ['&nbsp;' => 'NBS'], []);

        $this->assertEquals('10&nbsp;km &amp;shy; test', (string) $result);
    }

    #[Test]
    public function render_html_restores_entities_in_html(): void
    {
        $result = SafeEntities::renderHtml('<p>Geschäfts&amp;shy;bericht</p>', $this->entities, []);

        $this->assertEquals('<p>Geschäfts&shy;bericht</p>', (string) $result);
    }

    #[Test]
    public function render_html_preserves_existing_html_tags(): void
    {
        $result = SafeEntities::renderHtml('<p><strong>Bold</strong> &amp;shy; text</p>', $this->entities, []);

        $this->assertEquals('<p><strong>Bold</strong> &shy; text</p>', (string) $result);
    }

    #[Test]
    public function render_html_handles_null(): void
    {
        $result = SafeEntities::renderHtml(null, $this->entities);

        $this->assertEquals('', (string) $result);
    }

    #[Test]
    public function render_html_handles_empty_string(): void
    {
        $result = SafeEntities::renderHtml('', $this->entities);

        $this->assertEquals('', (string) $result);
    }

    // --- Alias tests ---

    #[Test]
    public function render_supports_aliased_entity(): void
    {
        $entities = [
            '&shy;' => 'Soft Hyphen',
            '&nnbsp;' => ['label' => 'Narrow No-Break Space', 'output' => '&#8239;'],
        ];

        $result = SafeEntities::render('10&nnbsp;km', $entities, []);

        $this->assertEquals('10&#8239;km', (string) $result);
    }

    #[Test]
    public function render_html_supports_aliased_entity(): void
    {
        $entities = [
            '&nnbsp;' => ['label' => 'Narrow No-Break Space', 'output' => '&#8239;'],
        ];

        $result = SafeEntities::renderHtml('<p>10&amp;nnbsp;km</p>', $entities, []);

        $this->assertEquals('<p>10&#8239;km</p>', (string) $result);
    }

    #[Test]
    public function render_handles_mixed_regular_and_aliased_entities(): void
    {
        $entities = [
            '&shy;' => 'Soft Hyphen',
            '&nnbsp;' => ['label' => 'Narrow No-Break Space', 'output' => '&#8239;'],
        ];

        $result = SafeEntities::render('Geschäfts&shy;bericht&nnbsp;2024', $entities, []);

        $this->assertEquals('Geschäfts&shy;bericht&#8239;2024', (string) $result);
    }

    // --- Replacement tests ---

    #[Test]
    public function render_applies_replacements(): void
    {
        $replacements = [
            '&lt;br&gt;' => '<br>',
        ];

        $result = SafeEntities::render('Line 1<br>Line 2', $this->entities, $replacements);

        $this->assertEquals('Line 1<br>Line 2', (string) $result);
    }

    #[Test]
    public function render_html_applies_replacements(): void
    {
        $replacements = [
            '<no-hyphens>' => '<span class="hyphens-none">',
            '</no-hyphens>' => '</span>',
        ];

        $result = SafeEntities::renderHtml('<p><no-hyphens>Text</no-hyphens></p>', $this->entities, $replacements);

        $this->assertEquals('<p><span class="hyphens-none">Text</span></p>', (string) $result);
    }

    #[Test]
    public function render_html_applies_encoded_tag_replacements(): void
    {
        $replacements = [
            '&lt;no-hyphens&gt;' => '<span class="hyphens-none">',
            '&lt;/no-hyphens&gt;' => '</span>',
        ];

        $result = SafeEntities::renderHtml('<p>&lt;no-hyphens&gt;Text&lt;/no-hyphens&gt;</p>', $this->entities, $replacements);

        $this->assertEquals('<p><span class="hyphens-none">Text</span></p>', (string) $result);
    }

    #[Test]
    public function render_with_empty_replacements_is_noop(): void
    {
        $result = SafeEntities::render('Hello &shy; World', $this->entities, []);

        $this->assertEquals('Hello &shy; World', (string) $result);
    }

    #[Test]
    public function render_applies_entities_and_replacements_together(): void
    {
        $entities = [
            '&shy;' => 'Soft Hyphen',
            '&nnbsp;' => ['label' => 'Narrow No-Break Space', 'output' => '&#8239;'],
        ];

        $replacements = [
            '&lt;br&gt;' => '<br>',
        ];

        $result = SafeEntities::render('Geschäfts&shy;bericht&nnbsp;2024<br>Seite 1', $entities, $replacements);

        $this->assertEquals('Geschäfts&shy;bericht&#8239;2024<br>Seite 1', (string) $result);
    }
}
