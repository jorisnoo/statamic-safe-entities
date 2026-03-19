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
        $this->mergeConfigFrom(__DIR__.'/../config/safe-entities.php', 'statamic.safe-entities');

        $this->publishes([
            __DIR__.'/../config/safe-entities.php' => config_path('statamic/safe-entities.php'),
        ], 'safe-entities-config');

        Statamic::provideToScript([
            'safeEntities' => $this->resolvedEntities(),
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
                    'entities' => array_merge(
                        $this->resolvedEntitiesForView(),
                        $this->resolvedReplacementsForView(),
                    ),
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
     * Build resolved replacement data for the utility view,
     * converting replacement patterns into the same row format as entities.
     */
    private function resolvedReplacementsForView(): array
    {
        $result = [];
        $seen = [];
        $entityCodes = collect(config('statamic.safe-entities.entities', []))
            ->map(fn ($value, $code) => is_int($code) ? $value : $code)
            ->values()
            ->all();

        foreach (config('statamic.safe-entities.replacements', []) as $pattern => $output) {
            $decoded = html_entity_decode($pattern, ENT_QUOTES | ENT_HTML5, 'UTF-8');

            if (in_array($decoded, $entityCodes) || isset($seen[$decoded])) {
                continue;
            }

            $seen[$decoded] = true;

            $labelKey = "statamic-safe-entities::messages.entities.{$decoded}";
            $label = __($labelKey);

            $descKey = "statamic-safe-entities::messages.descriptions.{$decoded}";
            $description = __($descKey);

            $result[] = [
                'code' => $decoded,
                'label' => $label !== $labelKey ? $label : $decoded,
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
