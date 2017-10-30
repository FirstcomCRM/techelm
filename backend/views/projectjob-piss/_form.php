<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ProjectJob;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobPiss */
/* @var $form yii\widgets\ActiveForm */
$ProjectJob = new ProjectJob;
$projectjob_ids = ArrayHelper::map($ProjectJob->find()->all(), 'id', 'project_ref');
?>

<div class="projectjob-piss-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'projectjob_id')->dropDownList($projectjob_ids) ?>
        </div>
        <div class="col-md-2">
           <?= $form->field($model, 'car_park_code')->textInput(['maxlength' => true, 'required'=> '']) ?> 
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'property_officer')->textInput(['maxlength' => true, 'required'=> '']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'tc_lew')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
           <?= $form->field($model, 'property_officer_telNo')->textInput(['maxlength' => true, 'type'=> 'number']) ?> 
        </div>
        <div class="col-md-2">
           <?= $form->field($model, 'property_officer_mobileNo')->textInput(['maxlength' => true, 'type'=> 'number']) ?> 
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'property_officer_branch')->textInput(['maxlength' => true, 'required'=> '']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'tc_lew_email')->textInput(['maxlength' => true, 'required'=> '', 'type'=> 'email']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'tc_lew_telNo')->textInput(['maxlength' => true, 'type'=> 'number']) ?>
        </div>
        <div class="col-md-2">
           <?= $form->field($model, 'tc_lew_mobileNo')->textInput(['maxlength' => true, 'type'=> 'number']) ?> 
        </div>
        <div class="col-md-2">
           <?= $form->field($model, 'date_site_walk')->textInput(['class'=> 'form-control datepicker']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
