<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: _form.php
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ovidiupop\identities\models\IdentityData */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="identity-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_identifier_type_id')->textInput() ?>
    <?= $form->field($model, 'person_identifier')->textInput(['maxlength' => true]) ?>
    <hr>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'additional_info')->textarea(['maxlength' => true]) ?>
    <hr>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'registration_number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'vat_number')->textInput() ?>
    <?= $form->field($model, 'vat_rate')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('identities', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
