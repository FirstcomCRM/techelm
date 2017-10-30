<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchServicejobUploads */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicejob-uploads-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'servicejob_id') ?>

    <?= $form->field($model, 'taken') ?>

    <?= $form->field($model, 'upload_name') ?>

    <?= $form->field($model, 'file_path') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'date_added') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
