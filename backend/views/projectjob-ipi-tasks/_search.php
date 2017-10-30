<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchProjectjobIpiTasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projectjob-ipi-tasks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-md-3">
        <?= $form->field($model, 'projectjob_id')->textInput(['placeholder'=>'Project Ref (eg. 3, 99, 120)'])->label(false) ?>
      </div>
      <div class="col-md-3">
        <?= $form->field($model, 'serial_no')->textInput(['placeholder'=>'Serial No'])->label(false) ?>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('<i class="fa fa-undo" aria-hidden="true"></i> Reset', ['class' => 'btn btn-primary']) ?>
        </div>
      </div>
    </div>

    <?php //$form->field($model, 'id') ?>





    <?php //$form->field($model, 'description') ?>

    <?php // $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'non_conformance') ?>

    <?php // echo $form->field($model, 'corrective_actions') ?>

    <?php // echo $form->field($model, 'target_completion_date') ?>

    <?php // echo $form->field($model, 'status_flag') ?>

    <?php // echo $form->field($model, 'date_updated') ?>

    <?php // echo $form->field($model, 'form_type') ?>



    <?php ActiveForm::end(); ?>

</div>
