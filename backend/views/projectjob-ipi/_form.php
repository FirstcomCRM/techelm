<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobIpi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projectjob-ipi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'projectjob_id')->textInput(['value'=> $_GET['project_job'], 'readonly'=> true]) ?>

    <?= $form->field($model, 'sub_contractor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'disposition_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dispo_by_siganture')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sub_c_date')->textInput() ?>

    <?= $form->field($model, 'dispo_by_date')->textInput() ?>

    <?= $form->field($model, 'date_inspected')->textInput() ?>

    <?= $form->field($model, 'form_type')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
