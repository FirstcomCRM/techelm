<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ToolboxActions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="toolbox-actions-form">

    <?php $form = ActiveForm::begin(); ?>

       <?= $form->field($model, 'details')->textarea(['rows' => 3])  ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
