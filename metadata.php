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
    'extend'      => [
        \OxidEsales\Eshop\Application\Model\User::class => \abicorios\OxidEshopBirthday\Model\User::class,
        \OxidEsales\Eshop\Application\Model\VoucherSerie::class => \abicorios\OxidEshopBirthday\Model\VoucherSerie::class,
        \OxidEsales\Eshop\Application\Model\Basket::class => \abicorios\OxidEshopBirthday\Model\Basket::class,
        \OxidEsales\Eshop\Application\Model\Voucher::class => \abicorios\OxidEshopBirthday\Model\Voucher::class,
    ],
    'blocks'      => [
        [
            'template' => 'page/shop/start.tpl',
            'block'    => 'start_welcome_text',
            'file'     => 'views/blocks/start__start_welcome_text.tpl',
            'position' => '1',
        ]
    ],
    'settings'    => [
        [
            'group' => 'OXAC_BIRTHDAY_TEXT',
            'name' => 'sBirthdayTextStart',
            'type' => 'str',
            'value' => 'Happy Birthday',
        ],
        [
            'group' => 'OXAC_BIRTHDAY_VOUCHER',
            'name' => 'oxacVoucherSerieId',
            'type' => 'str',
            'value' => '',
        ],
    ],
];
