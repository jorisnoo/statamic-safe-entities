<?php

return [

    'utility_title' => 'Special Characters',
    'utility_description' => 'A reference of special characters you can use in your content.',
    'utility_intro' => 'You can use these special codes in your text to control how words break and flow. Type them directly into any text field, or use the <strong>&amp;</strong> button in the rich text toolbar.',
    'column_code' => 'What to type',
    'column_label' => 'What it does',
    'column_preview' => 'Example',
    'replacements_title' => 'Custom Replacements',
    'replacements_intro' => 'These additional patterns are replaced in the rendered output.',
    'column_search' => 'Pattern',
    'column_replace' => 'Replaced with',

    'entities' => [
        // Hyphens & Dashes
        '&shy;' => 'Soft Hyphen',
        '&ndash;' => 'En Dash',
        '&mdash;' => 'Em Dash',

        // Spaces
        '&nbsp;' => 'Non-Breaking Space',
        '&nnbsp;' => 'Narrow No-Break Space',
        '&thinsp;' => 'Thin Space',
        '&hairsp;' => 'Hair Space',
        '&ensp;' => 'En Space',
        '&emsp;' => 'Em Space',

        // Zero-Width
        '&zwj;' => 'Zero-Width Joiner',
        '&zwnj;' => 'Zero-Width Non-Joiner',

        // Punctuation
        '&hellip;' => 'Ellipsis',
        '&bull;' => 'Bullet',
        '&middot;' => 'Middle Dot',

        // Quotation Marks
        '&laquo;' => 'Left Guillemet',
        '&raquo;' => 'Right Guillemet',
        '&lsaquo;' => 'Left Single Guillemet',
        '&rsaquo;' => 'Right Single Guillemet',
        '&ldquo;' => 'Left Double Quote',
        '&rdquo;' => 'Right Double Quote',
        '&lsquo;' => 'Left Single Quote',
        '&rsquo;' => 'Right Single Quote',
        '&sbquo;' => 'Single Low Quote',
        '&bdquo;' => 'Double Low Quote',

        // Math & Symbols
        '&times;' => 'Multiplication Sign',
        '&minus;' => 'Minus Sign',
        '&plusmn;' => 'Plus-Minus Sign',
        '&ne;' => 'Not Equal',
        '&le;' => 'Less Than or Equal',
        '&ge;' => 'Greater Than or Equal',
        '&deg;' => 'Degree Sign',
        '&prime;' => 'Prime (feet/minutes)',
        '&Prime;' => 'Double Prime (inches/seconds)',

        // Arrows
        '&larr;' => 'Left Arrow',
        '&rarr;' => 'Right Arrow',

        // Currency
        '&euro;' => 'Euro Sign',
        '&pound;' => 'Pound Sign',
        '&yen;' => 'Yen Sign',

        // Other
        '&trade;' => 'Trademark',
        '&reg;' => 'Registered',
        '&copy;' => 'Copyright',
    ],

];
