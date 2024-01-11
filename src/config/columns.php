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
    'id' => [
        'attribute' => 'id',
        'headerOptions' => ['width' => '60px'],
        'value' => 'id',
    ],

    'addressCountry' => [
        'attribute' => 'addressCountry',
        'label' => $searchModel->getAttributeLabel('address.country'),
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
        'label' => $searchModel->getAttributeLabel('address.region'),
        'value' => 'address.region',
    ],

    'addressCity' => [
        'attribute' => 'addressCity',
        'label' => $searchModel->getAttributeLabel('address.city'),
        'value' => 'address.city',
    ],

    'addressStreet' => [
        'attribute' => 'addressStreet',
        'label' => $searchModel->getAttributeLabel('address.street'),
        'value' => 'address.street',
    ],

    'addressHouseNumber' => [
        'attribute' => 'addressHouseNumber',
        'label' => $searchModel->getAttributeLabel('address.house_number'),
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
        'label' => $searchModel->getAttributeLabel('address.apartment_number'),
        'value' => 'address.apartment_number',
    ],

    'addressFull' => [
        'attribute' => 'addressFull',
        'label' => $searchModel->getAttributeLabel('addressFull'),
        'value' => 'addressFull',
    ],

    'addressPostalCode' => [
        'attribute' => 'addressPostalCode',
        'label' => $searchModel->getAttributeLabel('address.postal_code'),
        'value' => 'address.postal_code',
    ],

    'identityDataIdentityTypeId' => [
        'attribute' => 'identityDataIdentityTypeId',
        'label' => $searchModel->getAttributeLabel('identityData.identityType.type'),
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
        'label' => $searchModel->getAttributeLabel('identityData.name'),
        'value' => 'identityData.name',
    ],

    'identityDataIdentifier' => [
        'attribute' => 'identityDataIdentifier',
        'label' => $searchModel->getAttributeLabel('identityDataIdentifier'),
        'value' => function ($model) {
            return $model->identityData->identity_type_id === 1
                ? $model->identityData->person_identifier
                : $model->identityData->registration_number;
        },
    ],

    'identityDataVatNumber' => [
        'attribute' => 'identityDataVatNumber',
        'label' => $searchModel->getAttributeLabel('identityData.vat_number'),
        'value' => 'identityData.vat_number',
    ],

    'identityDataVatRate' => [
        'attribute' => 'identityDataVatRate',
        'label' => $searchModel->getAttributeLabel('identityData.vat_rate'),
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
        'label' => $searchModel->getAttributeLabel('identityData.person_identifier'),
        'value' => 'identityData.person_identifier',
    ],

    'identityDataRegistrationNumber' => [
        'attribute' => 'identityDataRegistrationNumber',
        'label' => $searchModel->getAttributeLabel('identityData.registration_number'),
        'value' => 'identityData.registration_number',
    ],

    'identityDataContactPerson' => [
        'attribute' => 'identityDataContactPerson',
        'label' => $searchModel->getAttributeLabel('identityData.contact_person'),
        'value' => 'identityData.contact_person',
    ],

    'identityDataPhone' => [
        'attribute' => 'identityDataPhone',
        'label' => $searchModel->getAttributeLabel('identityData.phone'),
        'value' => 'identityData.phone',
    ],
    'identityDataEmail' => [
        'attribute' => 'identityDataEmail',
        'label' => $searchModel->getAttributeLabel('identityData.email'),
        'value' => 'identityData.email',
    ],

    'identityDataIndustryId' => [
        'attribute' => 'identityDataIndustryId',
        'label' => $searchModel->getAttributeLabel('identityData.industry_id'),
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