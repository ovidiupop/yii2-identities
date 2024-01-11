<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/9/24
 * Filename: grid_config.php
 */

return [
    'visible' => [
        'id',
        'identityDataName',
        'identityDataRegistrationNumber',
        'identityDataVatNumber',
        'identityDataVatRate',
        'identityDataIndustryId',
        'identityDataPhone',
        'identityDataEmail',
        'addressCountry',
        'addressFull',
        'identityDataContactPerson',
    ],

    'hidden' => [
        'addressRegion',
        'addressCity',
        'addressStreet',
        'addressHouseNumber',
        'addressApartmentNumber',
        'addressPostalCode',
        'identityDataPersonIdentifier',
        'identityDataIdentifier',
        'identityDataIdentityTypeId',
    ]

];