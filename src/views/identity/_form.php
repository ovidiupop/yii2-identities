<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: _form.php
 */

use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ovidiupop\identities\models\Identity */
/* @var $identityData \ovidiupop\identities\models\IdentityData */
/* @var $addressModel \ovidiupop\address\models\Address */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="identity-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-6">
            <?= $form->field($identityData, 'identity_type_id')->widget(Select2::className(), [
                'data' => \ovidiupop\identities\models\IdentityType::getCmb(),
                'options' => [
                    'class' => 'identifier-type-select'
                ],
                'pluginOptions' => [
                    'allowClear' => false,
                ],
                'pluginEvents' => [
                    'change' => "function(){
                        $('.person-data').toggle(this.value !== '2');
                        $('.company-data').toggle(this.value === '2');
                }"
                ],
            ]) ?>
            <?= Yii::$app->getModule('address')->addressComponent->formInclude($addressModel, $form, 'custom') ?>
        </div>

        <div class="col-6">

            <span class="common-data">
                <?= $form->field($identityData, 'name')->textInput(['maxlength' => true]) ?>
            </span>

            <span class="person-data">
                <?= $form->field($identityData, 'person_identifier')->textInput(['maxlength' => true]) ?>
            </span>

            <span class="company-data" style="display: none;">
                <?= $form->field($identityData, 'registration_number')->textInput(['maxlength' => true]) ?>
                <?= $form->field($identityData, 'vat_number')->textInput() ?>
                <?= $form->field($identityData, 'vat_rate')->textInput(['maxlength' => true]) ?>
                <?= $form->field($identityData, 'contact_person')->textInput(['maxlength' => true]) ?>
            </span>

            <span class="common-data">
                <?= $form->field($identityData, 'phone')->textInput(['maxlength' => true]) ?>
                <?= $form->field($identityData, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($identityData, 'additional_info')->textarea(['maxlength' => true]) ?>
            </span>

            <?= $form->field($identityData, 'person_identifier_type_id')->hiddenInput(['class' => 'person_identifier_type_id'])->label(false) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('identities', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

