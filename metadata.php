<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = [
    'id'          => 'userbirthday',
    'title'       => [
        'de' => 'OXID Academy - Geburtstagsgrüße',
        'en' => 'OXID Academy - birthday greetings',
    ],
    'description' => [
        'de' => 'Sendet einen Geburtstagsgrüße an den Kunden, wenn er Geburtstag hat.',
        'en' => 'Generate birthday greetings when birthday.',
    ],
    'thumbnail'   => '',
    'version'     => '1.0',
    'author'      => 'Oxid Academy',
    'url'         => 'https://www.oxid-esales.com/',
    'email'       => 'academy@oxid-esales.com',
    'extend'      => [],
    'blocks'      => [],
    'settings'    => [
        [
            'group' => 'OXAC_BIRTHDAY_TEXT',
            'name' => 'sBirthdayTextStart',
            'type' => 'str',
            'value' => 'Happy Birthday',
        ]
    ],
];
