<?php

return [

    'utility_title' => 'Sonderzeichen',
    'utility_description' => 'Eine Übersicht der Sonderzeichen, die du in deinen Inhalten verwenden kannst.',
    'utility_intro' => 'Mit diesen Sonderzeichen kannst du steuern, wie Wörter umbrechen und fließen. Gib sie direkt in ein beliebiges Textfeld ein oder verwende die <strong>&amp;</strong>-Schaltfläche in der Rich-Text-Toolbar.',
    'column_code' => 'Was du eingibst',
    'column_label' => 'Was es bewirkt',
    'column_description' => 'Beschreibung',
    'replacements_title' => 'Benutzerdefinierte Ersetzungen',
    'replacements_intro' => 'Diese zusätzlichen Muster werden in der gerenderten Ausgabe ersetzt.',
    'column_search' => 'Muster',
    'column_replace' => 'Ersetzt durch',

    'descriptions' => [
        // Trennzeichen & Striche
        '&shy;' => 'Erlaubt einen Wortumbruch mit Bindestrich',
        '&ndash;' => 'Strich für Bereiche, z.B. 2020–2024',
        '&mdash;' => 'Langer Strich für Einschübe',

        // Leerzeichen
        '&nbsp;' => 'Leerzeichen, das keinen Zeilenumbruch erlaubt',
        '&nnbsp;' => 'Schmales Leerzeichen ohne Zeilenumbruch',
        '&thinsp;' => 'Schmales Leerzeichen, z.B. als Tausendertrennzeichen',
        '&hairsp;' => 'Kleinstmögliches Leerzeichen',
        '&ensp;' => 'Leerzeichen in der Breite eines Halbgeviertstriches',
        '&emsp;' => 'Leerzeichen in der Breite eines Geviertstriches',

        // Nullbreite
        '&zwj;' => 'Verbindet Zeichen ohne sichtbaren Abstand',
        '&zwnj;' => 'Verhindert die Verbindung von Zeichen',

        // Satzzeichen
        '&hellip;' => 'Drei Punkte: …',
        '&bull;' => 'Aufzählungspunkt: •',
        '&middot;' => 'Mittelpunkt: ·',

        // Anführungszeichen
        '&laquo;' => 'Doppelte spitze Anführungszeichen links: «',
        '&raquo;' => 'Doppelte spitze Anführungszeichen rechts: »',
        '&lsaquo;' => 'Einfaches spitzes Anführungszeichen links: ‹',
        '&rsaquo;' => 'Einfaches spitzes Anführungszeichen rechts: ›',
        '&ldquo;' => 'Öffnendes doppeltes Anführungszeichen: \u{201C}',
        '&rdquo;' => 'Schliessendes doppeltes Anführungszeichen: \u{201D}',
        '&lsquo;' => 'Öffnendes einfaches Anführungszeichen: \u{2018}',
        '&rsquo;' => 'Schliessendes einfaches Anführungszeichen: \u{2019}',
        '&sbquo;' => 'Einfaches Anführungszeichen unten: \u{201A}',
        '&bdquo;' => 'Doppeltes Anführungszeichen unten: \u{201E}',

        // Mathematik & Symbole
        '&times;' => 'Malzeichen, nicht der Buchstabe x',
        '&minus;' => 'Echtes Minuszeichen, kein Bindestrich',
        '&plusmn;' => 'Plus-Minus: ±',
        '&ne;' => 'Ungleich: ≠',
        '&le;' => 'Kleiner oder gleich: ≤',
        '&ge;' => 'Grösser oder gleich: ≥',
        '&deg;' => 'Gradzeichen, z.B. 23°C',
        '&prime;' => 'Minutenzeichen: ′',
        '&Prime;' => 'Sekundenzeichen: ″',

        // Pfeile
        '&larr;' => 'Pfeil nach links: ←',
        '&rarr;' => 'Pfeil nach rechts: →',

        // Währung
        '&euro;' => 'Eurozeichen: €',
        '&pound;' => 'Britisches Pfundzeichen: £',
        '&yen;' => 'Japanisches Yen-Zeichen: ¥',

        // Sonstiges
        '&trade;' => 'Markenzeichen: ™',
        '&reg;' => 'Eingetragenes Warenzeichen: ®',
        '&copy;' => 'Urheberrechtszeichen: ©',

        // Ersetzungen
        '<br>' => 'Fügt einen Zeilenumbruch in der Ausgabe ein',
        '<no-hyphens>' => 'Deaktiviert die automatische Silbentrennung für den eingeschlossenen Text',
        '</no-hyphens>' => 'Beendet den Bereich ohne Silbentrennung',
    ],

    'entities' => [
        // Trennzeichen & Striche
        '&shy;' => 'Weiches Trennzeichen',
        '&ndash;' => 'Halbgeviertstrich',
        '&mdash;' => 'Geviertstrich',

        // Leerzeichen
        '&nbsp;' => 'Geschütztes Leerzeichen',
        '&nnbsp;' => 'Schmales geschütztes Leerzeichen',
        '&thinsp;' => 'Schmales Leerzeichen',
        '&hairsp;' => 'Haardünnes Leerzeichen',
        '&ensp;' => 'Halbgeviert-Leerzeichen',
        '&emsp;' => 'Geviert-Leerzeichen',

        // Nullbreite
        '&zwj;' => 'Verbinder nullter Breite',
        '&zwnj;' => 'Trenner nullter Breite',

        // Satzzeichen
        '&hellip;' => 'Auslassungszeichen',
        '&bull;' => 'Aufzählungspunkt',
        '&middot;' => 'Mittelpunkt',

        // Anführungszeichen
        '&laquo;' => 'Linke Guillemets',
        '&raquo;' => 'Rechte Guillemets',
        '&lsaquo;' => 'Linkes einfaches Guillemet',
        '&rsaquo;' => 'Rechtes einfaches Guillemet',
        '&ldquo;' => 'Linkes doppeltes Anführungszeichen',
        '&rdquo;' => 'Rechtes doppeltes Anführungszeichen',
        '&lsquo;' => 'Linkes einfaches Anführungszeichen',
        '&rsquo;' => 'Rechtes einfaches Anführungszeichen',
        '&sbquo;' => 'Einfaches Anführungszeichen unten',
        '&bdquo;' => 'Doppeltes Anführungszeichen unten',

        // Mathematik & Symbole
        '&times;' => 'Malzeichen',
        '&minus;' => 'Minuszeichen',
        '&plusmn;' => 'Plus-Minus-Zeichen',
        '&ne;' => 'Ungleichzeichen',
        '&le;' => 'Kleiner oder gleich',
        '&ge;' => 'Grösser oder gleich',
        '&deg;' => 'Gradzeichen',
        '&prime;' => 'Minutenzeichen',
        '&Prime;' => 'Sekundenzeichen',

        // Pfeile
        '&larr;' => 'Pfeil nach links',
        '&rarr;' => 'Pfeil nach rechts',

        // Währung
        '&euro;' => 'Eurozeichen',
        '&pound;' => 'Pfundzeichen',
        '&yen;' => 'Yen-Zeichen',

        // Sonstiges
        '&trade;' => 'Markenzeichen',
        '&reg;' => 'Eingetragenes Warenzeichen',
        '&copy;' => 'Urheberrecht',

        // Ersetzungen
        '<br>' => 'Zeilenumbruch',
        '<no-hyphens>' => 'Silbentrennung deaktivieren',
        '</no-hyphens>' => 'Silbentrennung Ende',
    ],

];
