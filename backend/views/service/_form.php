<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ServiceCategory;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Service */
/* @var $form yii\widgets\ActiveForm */

$ServiceCategory = new ServiceCategory();
$Category_ids = ArrayHelper::map($ServiceCategory->find()->all(), 'id', 'description');
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-md-4">
            <?= $form->field($model, 'service_name')->textInput(['maxlength' => true, 'required'=> '']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'description')->textInput(['required'=> '']) ?>
        </div>
        <div class="col-md-4">
          
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'default_unit_price')->textInput(['type'=> 'number', 'required'=> '']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'status')->dropDownList([1=> 'Active', 0=> 'Inactive']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
