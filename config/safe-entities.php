<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Allowed HTML Entities
    |--------------------------------------------------------------------------
    |
    | Special characters that editors can use in their content.
    | Labels are provided via translation files (lang/{locale}/messages.php).
    |
    | To alias an entity to a different output code:
    |
    |   '&nnbsp;' => ['output' => '&#8239;'],
    |
    */

    'entities' => [
        '&shy;',
        '&nbsp;',
        '&ndash;',
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
