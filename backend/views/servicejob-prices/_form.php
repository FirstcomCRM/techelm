<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobPrices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servicejob-prices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'servicejob_id')->textInput() ?>

    <?= $form->field($model, 'replacement_parts')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
