<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: view.php
 */


use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model ovidiupop\identities\models\IdentityData */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('identities', 'Identity Data'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="identity-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('identities', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('identities', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('identities', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'person_identifier_type_id',
            'person_identifier',
            'phone',
            'email',
            'additional_info',
        ],
    ]) ?>

</div>
