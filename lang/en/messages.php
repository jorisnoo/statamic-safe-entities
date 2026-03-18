<?php

return [

    'utility_title' => 'Special Characters',
    'utility_description' => 'A reference of special characters you can use in your content.',
    'utility_intro' => 'You can use these special codes in your text to control how words break and flow. Type them directly into any text field, or use the <strong>&amp;</strong> button in the rich text toolbar.',
    'column_code' => 'What to type',
    'column_label' => 'What it does',
    'column_description' => 'Description',
    'replacements_title' => 'Custom Replacements',
    'replacements_intro' => 'These additional patterns are replaced in the rendered output.',
    'column_search' => 'Pattern',
    'column_replace' => 'Replaced with',

    'descriptions' => [
        // Hyphens & Dashes
        '&shy;' => 'Allows a word to break with a hyphen',
        '&ndash;' => 'Dash for ranges, e.g. 2020–2024',
        '&mdash;' => 'Long dash for parenthetical clauses',

        // Spaces
        '&nbsp;' => 'Space that prevents a line break',
        '&nnbsp;' => 'Narrow space that prevents a line break',
        '&thinsp;' => 'Narrow space, e.g. between thousands',
        '&hairsp;' => 'Thinnest possible space',
        '&ensp;' => 'Space the width of an en dash',
        '&emsp;' => 'Space the width of an em dash',

        // Zero-Width
        '&zwj;' => 'Joins characters without visible space',
        '&zwnj;' => 'Prevents characters from joining',

        // Punctuation
        '&hellip;' => 'Three dots: …',
        '&bull;' => 'Bullet point: •',
        '&middot;' => 'Centered dot: ·',

        // Quotation Marks
        '&laquo;' => 'Left double angle quote: «',
        '&raquo;' => 'Right double angle quote: »',
        '&lsaquo;' => 'Left single angle quote: ‹',
        '&rsaquo;' => 'Right single angle quote: ›',
        '&ldquo;' => 'Left double quotation mark: \u{201C}',
        '&rdquo;' => 'Right double quotation mark: \u{201D}',
        '&lsquo;' => 'Left single quotation mark: \u{2018}',
        '&rsquo;' => 'Right single quotation mark: \u{2019}',
        '&sbquo;' => 'Single low quotation mark: \u{201A}',
        '&bdquo;' => 'Double low quotation mark: \u{201E}',

        // Math & Symbols
        '&times;' => 'Multiplication sign, not the letter x',
        '&minus;' => 'True minus sign, not a hyphen',
        '&plusmn;' => 'Plus-minus: ±',
        '&ne;' => 'Not equal to: ≠',
        '&le;' => 'Less than or equal to: ≤',
        '&ge;' => 'Greater than or equal to: ≥',
        '&deg;' => 'Degree symbol, e.g. 23°C',
        '&prime;' => 'Prime mark for feet or minutes: ′',
        '&Prime;' => 'Double prime for inches or seconds: ″',

        // Arrows
        '&larr;' => 'Left-pointing arrow: ←',
        '&rarr;' => 'Right-pointing arrow: →',

        // Currency
        '&euro;' => 'Euro currency symbol: €',
        '&pound;' => 'British pound symbol: £',
        '&yen;' => 'Japanese yen symbol: ¥',

        // Other
        '&trade;' => 'Trademark symbol: ™',
        '&reg;' => 'Registered trademark: ®',
        '&copy;' => 'Copyright symbol: ©',
    ],

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
