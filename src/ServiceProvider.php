<?php

namespace Noo\SafeEntities;

use Illuminate\Foundation\Events\VendorTagPublished;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Statamic\Facades\Utility;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    protected $vite = [
        'input' => [
            'resources/js/safe-entities.js',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    public function bootAddon(): void
    {
        $this->app['events']->listen(VendorTagPublished::class, function (VendorTagPublished $event) {
            $source = $this->getAddon()->directory().'resources/dist/build/';
            $target = $event->paths[$source] ?? null;

            // Without --force Laravel may keep the old manifest. Never prune its chunks.
            if (! $target || ! File::isFile($target.'manifest.json')
                || ! File::hasSameHash($source.'manifest.json', $target.'manifest.json')) {
                return;
            }

            foreach (File::allFiles($target) as $file) {
                if (! File::isFile($source.$file->getRelativePathname())) {
                    File::delete($file->getPathname());
                }
            }
        });

        $this->mergeConfigFrom(__DIR__.'/../config/safe-entities.php', 'statamic.safe-entities');

        $this->publishes([
            __DIR__.'/../config/safe-entities.php' => config_path('statamic/safe-entities.php'),
        ], 'safe-entities-config');

        Statamic::provideToScript([
            'safeEntities' => fn () => $this->resolvedEntities(),
            'safeEntityButtons' => fn () => [
                'insert' => __('statamic-safe-entities::messages.utility_title'),
                'toggle' => __('statamic-safe-entities::messages.toggle_visibility'),
            ],
        ]);

        Blade::directive('entities', fn (string $expression) => "<?php echo \Noo\SafeEntities\SafeEntities::render($expression); ?>");
        Blade::directive('entitiesHtml', fn (string $expression) => "<?php echo \Noo\SafeEntities\SafeEntities::renderHtml($expression); ?>");

        Utility::extend(function ($utilities) {
            $utilities->register('safe_entities')
                ->title(__('statamic-safe-entities::messages.utility_title'))
                ->description(__('statamic-safe-entities::messages.utility_description'))
                ->icon('text-formatting-ampersand')
                ->view('statamic-safe-entities::utilities.index', fn () => [
                    'entities' => $this->resolvedEntities(),
                    'replacements' => config('statamic.safe-entities.replacements', []),
                ]);
        });
    }

    /** @return array<string, array{label: string, output: string}> */
    private function resolvedEntities(): array
    {
        $result = [];

        foreach (config('statamic.safe-entities.entities', []) as $code => $value) {
            $entityCode = is_int($code) ? $value : $code;
            if ($entityCode === '') {
                continue;
            }

            $label = is_array($value) ? ($value['label'] ?? null) : (is_int($code) ? null : $value);
            $key = "statamic-safe-entities::messages.entities.{$entityCode}";
            $result[$entityCode] = [
                'label' => $label ?? (trans()->has($key) ? __($key) : $entityCode),
                'output' => is_array($value) ? ($value['output'] ?? $entityCode) : $entityCode,
            ];
        }

        return $result;
    }
}
