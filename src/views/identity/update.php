<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: update.php
 */

/** @var \ovidiupop\identities\models\IdentityData $identityData */

/** @var  \ovidiupop\address\models\Address $addressModel */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ovidiupop\identities\models\Identity */

$this->title = Yii::t('identities', 'Update Identity: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('identities', 'Identities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('identities', 'Update');
?>
<div class="identity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'addressModel' => $addressModel,
        'identityData' => $identityData
    ]) ?>

</div>
