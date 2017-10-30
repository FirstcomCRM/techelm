<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchProjectjobIpi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projectjob-ipi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'projectjob_id') ?>

    <?= $form->field($model, 'sub_contractor') ?>

    <?= $form->field($model, 'disposition_by') ?>

    <?= $form->field($model, 'sub_c_signature') ?>

    <?php // echo $form->field($model, 'dispo_by_siganture') ?>

    <?php // echo $form->field($model, 'sub_c_date') ?>

    <?php // echo $form->field($model, 'dispo_by_date') ?>

    <?php // echo $form->field($model, 'date_inspected') ?>

    <?php // echo $form->field($model, 'form_type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
