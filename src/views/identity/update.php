<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: update.php
 */

use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $model ovidiupop\identities\models\Identity */
/** @var $identityData \ovidiupop\identities\models\IdentityData */
/** @var $addressModel \ovidiupop\address\models\Address */
/** @var $index string */
/** @var $view string */
/** @var $name string */
/** @var $form string */

$this->title = Yii::t('identities', 'Update');
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => $index];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => [$view, 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $model->identityData->name];
?>

<div class="identity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render($form, [
        'model' => $model,
        'addressModel' => $addressModel,
        'identityData' => $identityData,
    ]) ?>

</div>
