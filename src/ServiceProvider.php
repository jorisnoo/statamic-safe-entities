<?php

namespace Noo\SafeEntities;

use Illuminate\Console\Events\CommandStarting;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Statamic\Facades\Site;
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
        $this->app['events']->listen(CommandStarting::class, function (CommandStarting $event) {
            if ($event->command !== 'vendor:publish') {
                return;
            }

            if ($event->input->getOption('tag') !== $this->getAddon()->slug()) {
                return;
            }

            $buildPath = public_path('vendor/'.$this->getAddon()->packageName().'/build');

            if (File::isDirectory($buildPath)) {
                File::cleanDirectory($buildPath);
            }
        });

        $this->mergeConfigFrom(__DIR__.'/../config/safe-entities.php', 'statamic.safe-entities');

        $this->publishes([
            __DIR__.'/../config/safe-entities.php' => config_path('statamic/safe-entities.php'),
        ], 'safe-entities-config');

        Statamic::provideToScript([
            'safeEntities' => $this->resolvedEntities(),
            'safeEntitiesHyphenation' => config('statamic.safe-entities.hyphenation.languages', []),
            'safeEntitiesLocale' => Site::selected()->locale(),
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
                    'entities' => $this->resolvedEntitiesForView(),
                    'replacements' => config('statamic.safe-entities.replacements', []),
                ];
            });
    }

    /**
     * Build [code => label] for the Bard toolbar JS.
     */
    private function resolvedEntities(): array
    {
        $result = [];

        foreach (config('statamic.safe-entities.entities', []) as $code => $value) {
            $entityCode = is_int($code) ? $value : $code;
            $result[$entityCode] = $this->resolveLabel($code, $value);
        }

        return $result;
    }

    /**
     * Build resolved entity data for the utility view.
     */
    private function resolvedEntitiesForView(): array
    {
        $result = [];

        foreach (config('statamic.safe-entities.entities', []) as $code => $value) {
            $entityCode = is_int($code) ? $value : $code;
            $output = (is_array($value) && isset($value['output'])) ? $value['output'] : $entityCode;

            $descKey = "statamic-safe-entities::messages.descriptions.{$entityCode}";
            $description = __($descKey);

            $result[] = [
                'code' => $entityCode,
                'label' => $this->resolveLabel($code, $value),
                'output' => $output,
                'description' => $description !== $descKey ? $description : '',
            ];
        }

        return $result;
    }

    /**
     * Resolve a label for an entity code, checking translations first,
     * then falling back to config values.
     */
    private function resolveLabel(int|string $code, mixed $value): string
    {
        $entityCode = is_int($code) ? $value : $code;

        $transKey = "statamic-safe-entities::messages.entities.{$entityCode}";
        $label = __($transKey);

        if ($label !== $transKey) {
            return $label;
        }

        return match (true) {
            is_array($value) && isset($value['label']) => $value['label'],
            is_string($value) && ! is_int($code) => $value,
            default => $entityCode,
        };
    }
}
