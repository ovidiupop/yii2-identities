<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: _form.php
 */

use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \ovidiupop\identities\models\IdentityData;

/* @var $this yii\web\View */
/* @var $model ovidiupop\identities\models\Identity */
/* @var $identityData \ovidiupop\identities\models\IdentityData */
/* @var $addressModel \ovidiupop\address\models\Address */
/* @var $form yii\widgets\ActiveForm */
/* @var $type integer */


$type = $model->isNewRecord ? $type : $model->identityData->identity_type_id;
?>

<div class="identity-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-12">
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
                                togglePersonCompany();
                            }"
                        ],
                    ]) ?>
                </div>

                <div class="col-6">
                    <section class="common-data">
                        <?= $form->field($identityData, 'name')->textInput(['maxlength' => true]) ?>
                    </section>
                </div>

                <div class="col-6">
                    <section class="person-data">
                            <?= $form->field($identityData, 'person_identifier')->textInput(['maxlength' => true]) ?>
                    </section>
                    <section class="company-data" style="display: none;">
                            <?= $form->field($identityData, 'registration_number')->textInput(['maxlength' => true]) ?>
                    </section>
                </div>

                <div class="col-6">
                    <section class="company-data" style="display: none;">
                        <?= $form->field($identityData, 'vat_number')->textInput() ?>
                    </section>
                </div>

                <div class="col-6">
                    <section class="company-data" style="display: none;">
                        <?= $form->field($identityData, 'vat_rate')->textInput(['maxlength' => true]) ?>
                    </section>
                </div>

                <div class="col-6">
                    <section class="company-data" style="display: none;">
                        <?= $form->field($identityData, 'contact_person')->textInput(['maxlength' => true]) ?>
                    </section>
                </div>

                <div class="col-6">
                    <section class="company-data" style="display: none;">
                        <?= $form->field($identityData, 'industry')->widget(\kartik\widgets\Select2::className(), [
                            'data' => Yii::$app->industry->industries,
                        ]); ?>
                    </section>
                </div>

                <div class="col-6">
                    <section class="common-data">
                            <?= $form->field($identityData, 'phone')->textInput(['maxlength' => true]) ?>
                    </section>
                </div>

                <div class="col-6">
                    <section class="common-data">
                        <?= $form->field($identityData, 'email')->textInput(['maxlength' => true]) ?>
                    </section>
                </div>

                <div class="col-6">
                    <section class="common-data">
                        <?= $form->field($identityData, 'additional_info')->textarea(['maxlength' => true]) ?>
                    </section>
                </div>

            </div>
        </div>

        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    <?= Yii::$app->getModule('address')->addressComponent->formInclude($addressModel, $form, 'custom') ?>
                </div>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('identities', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?= $form->field($identityData, 'person_identifier_type_id')->hiddenInput(['class' => 'person_identifier_type_id'])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
