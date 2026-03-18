<?php

return [

    'utility_title' => 'Caractères spéciaux',
    'utility_description' => 'Une référence des caractères spéciaux utilisables dans vos contenus.',
    'utility_intro' => 'Utilisez ces codes spéciaux dans votre texte pour contrôler la césure et le flux des mots. Saisissez-les directement dans un champ texte ou utilisez le bouton <strong>&amp;</strong> dans la barre d\'outils du texte riche.',
    'column_code' => 'Ce qu\'il faut saisir',
    'column_label' => 'Ce que ça fait',
    'column_description' => 'Description',
    'replacements_title' => 'Remplacements personnalisés',
    'replacements_intro' => 'Ces motifs supplémentaires sont remplacés dans le rendu final.',
    'column_search' => 'Motif',
    'column_replace' => 'Remplacé par',

    'descriptions' => [
        // Traits d'union & tirets
        '&shy;' => 'Permet la coupure d\'un mot avec un trait d\'union',
        '&ndash;' => 'Tiret pour les plages, p. ex. 2020–2024',
        '&mdash;' => 'Tiret long pour les incises',

        // Espaces
        '&nbsp;' => 'Espace qui empêche le retour à la ligne',
        '&nnbsp;' => 'Espace fine qui empêche le retour à la ligne',
        '&thinsp;' => 'Espace fine, p. ex. entre les milliers',
        '&hairsp;' => 'Espace la plus fine possible',
        '&ensp;' => 'Espace de la largeur d\'un demi-cadratin',
        '&emsp;' => 'Espace de la largeur d\'un cadratin',

        // Largeur nulle
        '&zwj;' => 'Joint les caractères sans espace visible',
        '&zwnj;' => 'Empêche la jonction des caractères',

        // Ponctuation
        '&hellip;' => 'Points de suspension : …',
        '&bull;' => 'Puce : •',
        '&middot;' => 'Point médian : ·',

        // Guillemets
        '&laquo;' => 'Guillemet double ouvrant : «',
        '&raquo;' => 'Guillemet double fermant : »',
        '&lsaquo;' => 'Guillemet simple ouvrant : ‹',
        '&rsaquo;' => 'Guillemet simple fermant : ›',
        '&ldquo;' => 'Guillemet anglais double ouvrant : \u{201C}',
        '&rdquo;' => 'Guillemet anglais double fermant : \u{201D}',
        '&lsquo;' => 'Guillemet anglais simple ouvrant : \u{2018}',
        '&rsquo;' => 'Guillemet anglais simple fermant : \u{2019}',
        '&sbquo;' => 'Guillemet-virgule inférieur simple : \u{201A}',
        '&bdquo;' => 'Guillemet-virgule inférieur double : \u{201E}',

        // Mathématiques & symboles
        '&times;' => 'Signe de multiplication, pas la lettre x',
        '&minus;' => 'Vrai signe moins, pas un trait d\'union',
        '&plusmn;' => 'Plus ou moins : ±',
        '&ne;' => 'Différent de : ≠',
        '&le;' => 'Inférieur ou égal : ≤',
        '&ge;' => 'Supérieur ou égal : ≥',
        '&deg;' => 'Symbole degré, p. ex. 23°C',
        '&prime;' => 'Prime pour les pieds ou minutes : ′',
        '&Prime;' => 'Double prime pour les pouces ou secondes : ″',

        // Flèches
        '&larr;' => 'Flèche vers la gauche : ←',
        '&rarr;' => 'Flèche vers la droite : →',

        // Devises
        '&euro;' => 'Symbole euro : €',
        '&pound;' => 'Symbole livre sterling : £',
        '&yen;' => 'Symbole yen japonais : ¥',

        // Divers
        '&trade;' => 'Symbole marque déposée : ™',
        '&reg;' => 'Symbole marque enregistrée : ®',
        '&copy;' => 'Symbole droit d\'auteur : ©',
    ],

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
