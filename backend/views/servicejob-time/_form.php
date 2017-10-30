<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobTime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicejob-time-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'servicejob_id')->textInput() ?>

    <?= $form->field($model, 'start_task_time')->textInput() ?>

    <?= $form->field($model, 'count_time')->textInput() ?>

    <?= $form->field($model, 'end_task_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
