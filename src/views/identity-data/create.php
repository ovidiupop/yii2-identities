<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: create.php
 */


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ovidiupop\identities\models\IdentityData */

$this->title = Yii::t('identities', 'Create Identity Data');
$this->params['breadcrumbs'][] = ['label' => Yii::t('identities', 'Identity Data'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identity-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
