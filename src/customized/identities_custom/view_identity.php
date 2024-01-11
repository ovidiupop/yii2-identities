<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: view.php
 */

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model ovidiupop\identities\models\Identity */
/* @var $name string */
/* @var $index string */
/* @var $controller string */
/* @var $title string */

$this->params['breadcrumbs'][] = ['label' => $name, 'url' => $index];
$this->params['breadcrumbs'][] = ['label' => $model->identityData->name];

$this->title = $title;
?>

<?= $this->render('@backend/identities_custom/crud', ['controller' => $controller?? 'identities/identity', 'id' => $model->id, 'confirm' => 'Do you delete?']); ?>

<div class="identity-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute' => 'identityData.identity_type_id',
                'value' => $model->identityData->entityTypeName($model->identityData->identity_type_id),
            ],
            ['attribute' => 'identityData.name'],
            ['attribute' => 'identityData.registration_number', 'visible' => $model->identityData->registration_number !== null],
            ['attribute' => 'identityData.person_identifier_type_id',
                'value' => $model->identityData->person_identifier_type_id ? $model->identityData->personIdentifierType->type : null,
                'visible' => $model->identityData->person_identifier_type_id !== null
            ],
            ['attribute' => 'identityData.person_identifier', 'visible' => $model->identityData->person_identifier !== null],
            ['attribute' => 'identityData.vat_number', 'visible' => $model->identityData->vat_number],
            ['attribute' => 'identityData.vat_rate', 'visible' => $model->identityData->vat_rate !== null],
            ['attribute' => 'identityData.contact_person', 'visible' => $model->identityData->contact_person],
            ['attribute' => 'identityData.phone', 'visible' => $model->identityData->phone],
            ['attribute' => 'identityData.email', 'visible' => $model->identityData->email],
            ['attribute' => 'identityData.additional_info', 'visible' => $model->identityData->additional_info],
            ['attribute' => 'address.country',
                'value' => $model->getCountryName($model->address->country),
            ],
            ['attribute' => 'address.region', 'visible' => $model->address->region],
            ['attribute' => 'address.city'],
            ['attribute' => 'address.postal_code'],
            ['attribute' => 'address.street'],
            ['attribute' => 'address.house_number', 'visible' => $model->address->house_number],
            ['attribute' => 'address.apartment_number', 'visible' => $model->address->apartment_number],
        ]
    ]) ?>
</div>
