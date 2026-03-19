<div class="card p-4">
    <p class="text-sm text-gray-700 dark:text-dark-175 mb-4">
        {!! __('statamic-safe-entities::messages.utility_intro') !!}
    </p>

    <table class="data-table">
        <thead>
            <tr>
                <th>{{ __('statamic-safe-entities::messages.column_code') }}</th>
                <th>{{ __('statamic-safe-entities::messages.column_label') }}</th>
                <th>{{ __('statamic-safe-entities::messages.column_description') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entities as $entity)
                <tr>
                    <td><code class="font-mono text-sm">{{ $entity['code'] }}</code></td>
                    <td class="text-sm">{{ $entity['label'] }}</td>
                    <td class="text-sm">{{ $entity['description'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
