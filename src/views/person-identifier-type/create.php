<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: create.php
 */


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ovidiupop\identities\models\PersonIdentifierType */

$this->title = 'Create Person Identifier Type';
$this->params['breadcrumbs'][] = ['label' => 'Person Identifier Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-identifier-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
