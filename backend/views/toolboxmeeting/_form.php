<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Toolboxmeeting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="toolboxmeeting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'projectjob_id')->textInput() ?>

    <?= $form->field($model, 'meeting_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meeting_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conducted_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'signature')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_flag_tm')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
