<?php

namespace Noo\SafeEntities\Tests;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Noo\SafeEntities\ServiceProvider;
use Statamic\Facades\Utility;
use Statamic\Fields\Field;
use Statamic\Statamic;
use Statamic\Testing\AddonTestCase;

class ServiceProviderTest extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;

    private string $publicDirectory;

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $this->publicDirectory = sys_get_temp_dir().'/safe-entities-'.bin2hex(random_bytes(8));
        $app->usePublicPath($this->publicDirectory);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->publicDirectory);
        parent::tearDown();
    }

    public function test_blade_directives_use_published_defaults_and_preserve_bard_html(): void
    {
        $this->assertSame('&lt;em&gt;&shy;', Blade::render('@entities($text)', ['text' => '<em>&shy;']));
        $this->assertSame('<p>&nbsp;</p>', Blade::render('@entitiesHtml($html)', ['html' => '<p>&amp;nbsp;</p>']));

        $field = new Field('content', ['type' => 'bard', 'sets' => ['media' => ['fields' => []]]]);
        $sets = $field->fieldtype()->augment([
            ['type' => 'paragraph', 'content' => [['type' => 'text', 'text' => 'a&shy;b']]],
        ]);
        $html = Blade::render(<<<'BLADE'
            @foreach ($sets as $set)
                @if ($set->type === 'text')
                    @entitiesHtml($set->text)
                @endif
            @endforeach
            BLADE, compact('sets'));
        $this->assertSame('<p>a&shy;b</p>', trim($html));
    }

    public function test_bard_and_utility_resolve_labels_in_the_current_cp_locale(): void
    {
        config(['statamic.safe-entities.entities' => [
            '&shy;', '&nbsp;' => 'Fixed space', '&nnbsp;' => ['label' => 'Narrow', 'output' => '&#8239;'], '&custom;',
        ]]);
        config(['statamic.safe-entities.replacements' => ['<no-hyphens>' => '<span>']]);

        foreach (['en' => ['Special Characters', 'Soft Hyphen'], 'de' => ['Sonderzeichen', 'Weiches Trennzeichen']] as $locale => [$title, $softHyphen]) {
            app()->setLocale($locale);
            $payload = Statamic::jsonVariables(request());
            $this->assertSame($title, $payload['safeEntityButtons']['insert']);
            $this->assertSame([
                '&shy;' => ['label' => $softHyphen, 'output' => '&shy;'],
                '&nbsp;' => ['label' => 'Fixed space', 'output' => '&nbsp;'],
                '&nnbsp;' => ['label' => 'Narrow', 'output' => '&#8239;'],
                '&custom;' => ['label' => '&custom;', 'output' => '&custom;'],
            ], $payload['safeEntities']);
            $utility = Utility::boot()->find('safe_entities');
            $this->assertSame($title, $utility->title());
            $this->assertSame($title, $utility->navTitle());
            $this->assertSame(__('statamic-safe-entities::messages.utility_description'), $utility->description());
            $html = view($utility->view(), $utility->viewData(request()))->render();
            $this->assertStringContainsString($softHyphen, $html);
            $this->assertStringContainsString('<code>&lt;no-hyphens&gt;</code>', $html);
            $this->assertStringContainsString('<code>&lt;span&gt;</code>', $html);
        }
    }

    public function test_utility_describes_quotes_in_each_bundled_locale(): void
    {
        $quotes = ['&ldquo;', '&rdquo;', '&lsquo;', '&rsquo;', '&sbquo;', '&bdquo;'];
        config(['statamic.safe-entities.entities' => $quotes]);
        foreach (['en', 'de', 'fr'] as $locale) {
            app()->setLocale($locale);
            $utility = Utility::boot()->find('safe_entities');
            $html = view($utility->view(), $utility->viewData(request()))->render();
            foreach ($quotes as $quote) {
                $this->assertStringContainsString(html_entity_decode($quote), $html);
            }
        }
    }

    public function test_publishing_prunes_obsolete_files_only_after_the_manifest_is_updated(): void
    {
        $build = public_path('vendor/statamic-safe-entities/build');
        File::ensureDirectoryExists($build.'/assets');
        File::put($build.'/manifest.json', '{"old": true}');
        File::put($build.'/assets/old.js', 'old');
        $this->artisan('vendor:publish', ['--tag' => ['statamic-safe-entities']])->assertSuccessful();
        $this->assertFileExists($build.'/assets/old.js');
        $this->artisan('vendor:publish', ['--tag' => ['unrelated-tag', 'statamic-safe-entities'], '--force' => true])->assertSuccessful();
        $this->assertFileDoesNotExist($build.'/assets/old.js');
        $manifest = json_decode(File::get($build.'/manifest.json'), true, flags: JSON_THROW_ON_ERROR);
        $this->assertFileExists($build.'/'.$manifest['resources/js/safe-entities.js']['file']);
    }
}
