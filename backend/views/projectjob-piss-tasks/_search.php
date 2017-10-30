<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchProjectjobPissTasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projectjob-piss-tasks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-md-3">
        <?= $form->field($model, 'projectjob_id')->textInput(['placeholder'=>'Project Ref (e.g 9,39, 100)'])->label(false) ?>
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


    <?php // $form->field($model, 'description') ?>

    <?php // $form->field($model, 'conformance') ?>

    <?php // $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'drawing_before') ?>

    <?php // echo $form->field($model, 'drawing_after') ?>

    <?php // echo $form->field($model, 'date_updated') ?>



    <?php ActiveForm::end(); ?>

</div>
