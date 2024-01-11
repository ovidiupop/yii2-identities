<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/9/24
 * Filename: grid_config.php
 */

return [
    'visible' => [
        'id',
        'identityDataIdentityTypeId',
        'identityDataName',
        'identityDataIdentifier',
        'identityDataVatNumber',
        'identityDataVatRate',
        'identityDataContactPerson',
        'identityDataPhone',
        'identityDataEmail',
        'addressCountry',
        'addressFull',
        'identityDataIndustryId',
    ],

    'hidden' => [
        'addressRegion',
        'addressCity',
        'addressStreet',
        'addressHouseNumber',
        'addressApartmentNumber',
        'addressPostalCode',
        'identityDataPersonIdentifier',
        'identityDataRegistrationNumber',
    ]

];