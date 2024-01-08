<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/7/24
 * Filename: columns.php
 */

use ovidiupop\identities\models\Identity;
use ovidiupop\identities\models\IdentityData;
use ovidiupop\identities\models\IdentityType;
use ovidiupop\identities\models\PersonIdentifierType;
use kartik\widgets\Select2;

/* @var $searchModel ovidiupop\identities\models\search\IdentitySearch */

return [
    'addressCountry' => [
        'attribute' => 'addressCountry',
        'value' => function ($model) {
            return $model->getCountryName($model->address->country);
        },
        'filter' => Select2::widget([
            'model' => $searchModel,
            'attribute' => 'addressCountry',
            'data' => Identity::cmbAddressCountries(),
            'options' => [
                'placeholder' => Yii::t('identities', 'Select...'),
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]),
    ],

    'addressRegion' => [
        'attribute' => 'addressRegion',
        'value' => 'address.region',
    ],

    'addressCity' => [
        'attribute' => 'addressCity',
        'value' => 'address.city',
    ],

    'addressStreet' => [
        'attribute' => 'addressStreet',
        'value' => 'address.street',
    ],

    'addressHouseNumber' => [
        'attribute' => 'addressHouseNumber',
        'value' => 'address.house_number',
        'filter' => Select2::widget([
            'model' => $searchModel,
            'attribute' => 'addressHouseNumber',
            'data' => Identity::cmbColumnValues(\ovidiupop\address\models\Address::class, 'house_number'),
            'options' => [
                'placeholder' => Yii::t('identities', 'Select...'),
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]),
    ],

    'addressApartmentNumber' => [
        'attribute' => 'addressApartmentNumber',
        'value' => 'address.apartment_number',
    ],

    'addressFull' => [
        'attribute' => 'addressFull',
        'value' => 'addressFull',
    ],

    'addressPostalCode' => [
        'attribute' => 'addressPostalCode',
        'value' => 'address.postal_code',
    ],

    'identityDataIdentityTypeId' => [
        'attribute' => 'identityDataIdentityTypeId',
        'value' => 'identityData.identityType.type',
        'filter' => Select2::widget([
            'model' => $searchModel,
            'attribute' => 'identityDataIdentityTypeId',
            'data' => IdentityType::getCmb(),
            'options' => [
                'placeholder' => Yii::t('identities', 'Select...'),
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]),
    ],


    'identityDataName' => [
        'attribute' => 'identityDataName',
        'value' => 'identityData.name',
    ],

    'identityDataIdentifier' => [
        'attribute' => 'identityDataIdentifier',
        'value' => function ($model) {
            return $model->identityData->identity_type_id === 1
                ? $model->identityData->person_identifier
                : $model->identityData->registration_number;
        },
    ],

    'identityDataVatNumber' => [
        'attribute' => 'identityDataVatNumber',
        'value' => 'identityData.vat_number',
    ],

    'identityDataVatRate' => [
        'attribute' => 'identityDataVatRate',
        'value' => 'identityData.vat_rate',
        'filter' => Select2::widget([
            'model' => $searchModel,
            'attribute' => 'identityDataVatRate',
            'data' => Identity::cmbColumnValues(IdentityData::class, 'vat_rate'),
            'options' => [
                'placeholder' => Yii::t('identities', 'Select...'),
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]),
    ],

    'identityDataPersonIdentifier' => [
        'attribute' => 'identityDataPersonIdentifier',
        'value' => 'identityData.person_identifier',
    ],

    'identityDataRegistrationNumber' => [
        'attribute' => 'identityDataRegistrationNumber',
        'value' => 'identityData.registration_number',
    ],

    'identityDataContactPerson' => [
        'attribute' => 'identityDataContactPerson',
        'value' => 'identityData.contact_person',
    ],

    'identityDataPhone' => [
        'attribute' => 'identityDataPhone',
        'value' => 'identityData.phone',
    ],
    'identityDataEmail' => [
        'attribute' => 'identityDataEmail',
        'value' => 'identityData.email',
    ],

    'identityDataIndustryId' => [
        'attribute' => 'identityDataIndustryId',
        'value' => 'identityData.industry_id',
        'filter' => Select2::widget([
            'model' => $searchModel,
            'attribute' => 'identityDataIndustryId',
            'data' => PersonIdentifierType::getCmb(),
            'options' => [
                'placeholder' => Yii::t('identities', 'Select...'),
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]),
    ],

];