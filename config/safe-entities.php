<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Allowed HTML Entities
    |--------------------------------------------------------------------------
    |
    | Special characters that editors can use in their content.
    | Each entry maps a code to a description shown in the toolbar and
    | the Special Characters utility page.
    |
    | You can also alias an entity to a different output code:
    |
    |   '&nnbsp;' => ['label' => 'Narrow No-Break Space', 'output' => '&#8239;'],
    |
    */

    'entities' => [
        '&shy;' => 'Allows a word to break here if needed',
        '&nbsp;' => 'Keeps two words on the same line',
        '&ndash;' => 'En dash (longer than a hyphen)',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Replacements
    |--------------------------------------------------------------------------
    |
    | Additional string replacements applied after entity restoration.
    | Use this for custom tags or other patterns that should be converted
    | in the rendered output.
    |
    | Example:
    |
    |   '&lt;br&gt;'            => '<br>',
    |   '&lt;no-hyphens&gt;'    => '<span class="hyphens-none">',
    |   '&lt;/no-hyphens&gt;'   => '</span>',
    |   '<no-hyphens>'          => '<span class="hyphens-none">',
    |   '</no-hyphens>'         => '</span>',
    |
    */

    'replacements' => [
        //
    ],

];
