<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchProjectjobPiss */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projectjob-piss-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'projectjob_id') ?>

    <?= $form->field($model, 'car_park_code') ?>

    <?= $form->field($model, 'property_officer') ?>

    <?= $form->field($model, 'tc_lew') ?>

    <?php // echo $form->field($model, 'property_officer_telNo') ?>

    <?php // echo $form->field($model, 'property_officer_mobileNo') ?>

    <?php // echo $form->field($model, 'property_officer_branch') ?>

    <?php // echo $form->field($model, 'tc_lew_telNo') ?>

    <?php // echo $form->field($model, 'tc_lew_mobileNo') ?>

    <?php // echo $form->field($model, 'tc_lew_email') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'date_site_walk') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
