<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/3/24
 * Filename: main.php
 */

return [
    'modules' => [
        'address' => [
            'class' => 'ovidiupop\address\AddressModule',
            'formCustom' => '@backend/views/companies/custom_address_form',
        ],
    ],
    'components' => [
        'industry' => [
            'class' => 'ovidiupop\identities\components\industry\IndustryComponent',
        ],
    ],
];