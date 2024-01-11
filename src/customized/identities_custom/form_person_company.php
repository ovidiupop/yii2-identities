<?php
/**
 * Author: Antonio Ovidiu Pop
 * Date: 1/5/24
 * Filename: _form.php
 */

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
custom
<div class="identity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($identityData, 'identity_type_id')->hiddenInput(['value' => $type])->label(false) ?>

    <div class="row">
        <div class="col-6">
            <div class="row">

                <?php if ((int)$type === IdentityData::PERSON): ?>
                    <div class="col-12">
                        <?= $form->field($identityData, 'name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'person_identifier')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'phone')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'email')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'additional_info')->textarea(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'person_identifier_type_id')->hiddenInput(['class' => 'person_identifier_type_id'])->label(false) ?>
                    </div>
                <?php else: ?>
                    <div class="col-6">
                        <?= $form->field($identityData, 'name')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'registration_number')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'vat_number')->textInput() ?>
                        <?= $form->field($identityData, 'vat_rate')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'industry')->widget(\kartik\widgets\Select2::className(), [
                            'data' => Yii::$app->industry->industries,
                        ]); ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($identityData, 'contact_person')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'phone')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'email')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($identityData, 'additional_info')->textarea(['maxlength' => true]) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-6">
            <?= Yii::$app->getModule('address')->addressComponent->formInclude($addressModel, $form, 'custom') ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('identities', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

