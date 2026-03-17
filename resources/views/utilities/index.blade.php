<div class="card p-4">
    <p class="text-sm text-gray-700 dark:text-dark-175 mb-4">
        {!! __('statamic-safe-entities::messages.utility_intro') !!}
    </p>

    <table class="data-table">
        <thead>
            <tr>
                <th>{{ __('statamic-safe-entities::messages.column_code') }}</th>
                <th>{{ __('statamic-safe-entities::messages.column_label') }}</th>
                <th>{{ __('statamic-safe-entities::messages.column_preview') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entities as $code => $value)
                <tr>
                    <td><code class="font-mono text-sm">{{ $code }}</code></td>
                    <td class="text-sm">{{ is_array($value) ? $value['label'] : (is_string($value) ? $value : $code) }}</td>
                    <td class="text-sm">Wort{!! is_array($value) && isset($value['output']) ? $value['output'] : $code !!}Wort</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (!empty($replacements))
        <h2 class="mt-6 mb-2 text-base font-semibold">{{ __('statamic-safe-entities::messages.replacements_title') }}</h2>
        <p class="text-sm text-gray-700 dark:text-dark-175 mb-4">
            {{ __('statamic-safe-entities::messages.replacements_intro') }}
        </p>

        <table class="data-table">
            <thead>
                <tr>
                    <th>{{ __('statamic-safe-entities::messages.column_search') }}</th>
                    <th>{{ __('statamic-safe-entities::messages.column_replace') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($replacements as $search => $replace)
                    <tr>
                        <td><code class="font-mono text-sm">{{ $search }}</code></td>
                        <td><code class="font-mono text-sm">{{ $replace }}</code></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
