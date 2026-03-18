<?php

return [

    'utility_title' => 'Caractères spéciaux',
    'utility_description' => 'Une référence des caractères spéciaux utilisables dans vos contenus.',
    'utility_intro' => 'Utilisez ces codes spéciaux dans votre texte pour contrôler la césure et le flux des mots. Saisissez-les directement dans un champ texte ou utilisez le bouton <strong>&amp;</strong> dans la barre d\'outils du texte riche.',
    'column_code' => 'Ce qu\'il faut saisir',
    'column_label' => 'Ce que ça fait',
    'column_preview' => 'Exemple',
    'replacements_title' => 'Remplacements personnalisés',
    'replacements_intro' => 'Ces motifs supplémentaires sont remplacés dans le rendu final.',
    'column_search' => 'Motif',
    'column_replace' => 'Remplacé par',

    'entities' => [
        // Traits d'union & tirets
        '&shy;' => 'Trait d\'union conditionnel',
        '&ndash;' => 'Tiret demi-cadratin',
        '&mdash;' => 'Tiret cadratin',

        // Espaces
        '&nbsp;' => 'Espace insécable',
        '&nnbsp;' => 'Espace fine insécable',
        '&thinsp;' => 'Espace fine',
        '&hairsp;' => 'Espace ultrafine',
        '&ensp;' => 'Espace demi-cadratin',
        '&emsp;' => 'Espace cadratin',

        // Largeur nulle
        '&zwj;' => 'Liant sans chasse',
        '&zwnj;' => 'Antiliant sans chasse',

        // Ponctuation
        '&hellip;' => 'Points de suspension',
        '&bull;' => 'Puce',
        '&middot;' => 'Point médian',

        // Guillemets
        '&laquo;' => 'Guillemet ouvrant',
        '&raquo;' => 'Guillemet fermant',
        '&lsaquo;' => 'Guillemet simple ouvrant',
        '&rsaquo;' => 'Guillemet simple fermant',
        '&ldquo;' => 'Guillemet anglais ouvrant',
        '&rdquo;' => 'Guillemet anglais fermant',
        '&lsquo;' => 'Guillemet anglais simple ouvrant',
        '&rsquo;' => 'Guillemet anglais simple fermant',
        '&sbquo;' => 'Guillemet-virgule inférieur',
        '&bdquo;' => 'Guillemet-virgule double inférieur',

        // Mathématiques & symboles
        '&times;' => 'Signe de multiplication',
        '&minus;' => 'Signe moins',
        '&plusmn;' => 'Signe plus ou moins',
        '&ne;' => 'Différent de',
        '&le;' => 'Inférieur ou égal',
        '&ge;' => 'Supérieur ou égal',
        '&deg;' => 'Symbole degré',
        '&prime;' => 'Prime (pieds/minutes)',
        '&Prime;' => 'Double prime (pouces/secondes)',

        // Flèches
        '&larr;' => 'Flèche gauche',
        '&rarr;' => 'Flèche droite',

        // Devises
        '&euro;' => 'Symbole euro',
        '&pound;' => 'Symbole livre',
        '&yen;' => 'Symbole yen',

        // Divers
        '&trade;' => 'Marque déposée',
        '&reg;' => 'Marque enregistrée',
        '&copy;' => 'Droit d\'auteur',
    ],

];
