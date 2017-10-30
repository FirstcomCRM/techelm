<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobUploads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicejob-uploads-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'servicejob_id')->textInput() ?>

    <?= $form->field($model, 'taken')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'upload_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file_path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_added')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
