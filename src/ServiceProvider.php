<?php

namespace Noo\SafeEntities;

use Illuminate\Support\Facades\Blade;
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
            'safeEntities' => config('statamic.safe-entities.entities', []),
        ]);

        Blade::directive('entities', fn (string $expression) => "<?php echo \Noo\SafeEntities\SafeEntities::render($expression); ?>");
        Blade::directive('entitiesHtml', fn (string $expression) => "<?php echo \Noo\SafeEntities\SafeEntities::renderHtml($expression); ?>");
    }
}
