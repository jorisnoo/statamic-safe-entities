<?php

namespace Noo\SafeEntities;

use Illuminate\Support\Facades\Blade;
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
        $this->mergeConfigFrom(__DIR__ . '/../config/safe-entities.php', 'statamic.safe-entities');

        $this->publishes([
            __DIR__ . '/../config/safe-entities.php' => config_path('statamic/safe-entities.php'),
        ], 'safe-entities-config');

        Statamic::provideToScript([
            'safeEntities' => collect(config('statamic.safe-entities.entities', []))
                ->mapWithKeys(fn ($value, $code) => [
                    $code => is_array($value) ? $value['label'] : $value,
                ])
                ->all(),
        ]);

        Blade::directive('entities', fn (string $expression) => "<?php echo \Noo\SafeEntities\SafeEntities::render($expression); ?>");
        Blade::directive('entitiesHtml', fn (string $expression) => "<?php echo \Noo\SafeEntities\SafeEntities::renderHtml($expression); ?>");

        Utility::register('safe_entities')
            ->title(__('statamic-safe-entities::messages.utility_title'))
            ->navTitle(__('statamic-safe-entities::messages.utility_title'))
            ->description(__('statamic-safe-entities::messages.utility_description'))
            ->icon('text-formatting-ampersand')
            ->view('statamic-safe-entities::utilities.index', function () {
                return [
                    'entities' => config('statamic.safe-entities.entities', []),
                    'replacements' => config('statamic.safe-entities.replacements', []),
                ];
            });
    }
}
