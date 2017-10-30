<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Projectjob */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projectjob-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'targe_completion_date')->textInput() ?>

    <?= $form->field($model, 'first_inspector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'second_inspector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'third_inspector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
