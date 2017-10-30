<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Equipments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipments-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    	<div class="col-md-4">
		    <?= $form->field($model, 'description')->textInput(['required'=> '']) ?>
    	</div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
