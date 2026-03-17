<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Allowed HTML Entities
    |--------------------------------------------------------------------------
    |
    | These HTML entities can be used by editors in text, textarea, and Bard
    | fields. Each entry maps an entity code to a human-readable label shown
    | in the Bard toolbar dropdown.
    |
    | The @entities directive allows these through in escaped text fields.
    | The @entitiesHtml directive restores these in Bard HTML output.
    |
    */

    'entities' => [
        '&shy;' => 'Soft Hyphen',
        '&nbsp;' => 'Non-Breaking Space',
        '&ndash;' => 'En Dash',
    ],

];
