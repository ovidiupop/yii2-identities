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
        'identityDataPersonIdentifier',
        'identityDataPhone',
        'identityDataEmail',
        'addressCountry',
        'addressFull',
    ],

    'hidden' => [
        'addressRegion',
        'addressCity',
        'addressStreet',
        'addressHouseNumber',
        'addressApartmentNumber',
        'addressPostalCode',
        'identityDataRegistrationNumber',
        'identityDataIndustryId',
        'identityDataVatNumber',
        'identityDataVatRate',
        'identityDataContactPerson',
        'identityDataIdentifier',
        //        'identityDataIdentityTypeId',
    ]

];