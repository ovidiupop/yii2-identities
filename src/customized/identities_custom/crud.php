<?php
/* @var $controller string */
/* @var $confirm string */
/* @var $id integer */
?>

<div class="row-buttons-actions clearfix">
    <div class="pull-right">
        <?= \yii\helpers\Html::a('<i class="fa fa-list"> </i>  ' . Yii::t('app', 'Administration'), ["/$controller/index"], ['class' => 'btn btn-warning']) ?>
        <?= \yii\helpers\Html::a('<i class="fa fa-edit"> </i>  ' . Yii::t('app', 'Update'), ["/$controller/update", 'id' => $id], ['class' => 'btn btn-primary']) ?>
        <?= \yii\helpers\Html::a('<i class="fa fa-times"> </i> ' . Yii::t('app', 'Delete'), ["/$controller/delete", 'id' => $id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => $confirm ?: Yii::t('app', 'Do you delete?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php if (!isset($noAdd)) {
            echo \yii\helpers\Html::a('<i class="fa fa-plus"> </i> ' . Yii::t('app', 'Add'), ["/$controller/create"], ['class' => 'btn btn-info']);
        } ?>
    </div>
</div>