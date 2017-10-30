<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchToolboxmeeting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="toolboxmeeting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php $form->field($model, 'id') ?>

    <?= $form->field($model, 'projectjob_id') ?>

    <?= $form->field($model, 'meeting_image') ?>

    <?= $form->field($model, 'meeting_details') ?>

    <?= $form->field($model, 'conducted_by') ?>

    <?php // echo $form->field($model, 'designation') ?>

    <?php // echo $form->field($model, 'month') ?>

    <?php // echo $form->field($model, 'signature') ?>

    <?php // echo $form->field($model, 'status_flag_tm') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
