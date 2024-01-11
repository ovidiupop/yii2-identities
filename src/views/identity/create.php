<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: create.php
 */

use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $model ovidiupop\identities\models\Identity */
/** @var $identityData \ovidiupop\identities\models\IdentityData */
/** @var $addressModel \ovidiupop\address\models\Address */
/** @var $index string */
/** @var $form string */
/** @var $name string */
/** @var $type string */

$this->title = Yii::t('identities', 'Add');
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => $index];
?>
<div class="identity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render($form, [
        'model' => $model,
        'addressModel' => $addressModel,
        'identityData' => $identityData,
        'type' => $type
    ]) ?>

</div>
