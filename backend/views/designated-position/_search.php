<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SearchDesignatedPosition */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="designated-position-search">

<?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get']); ?>

<div class="row">
    <div class="col-md-12">
        <div class="search-label-container">
            <span class="search-label"><i class="fa fa-pencil"></i> Enter keyword here</span>
        </div> 
    </div>
    <br/>

    <div class="col-md-5">
        <?= $form->field($model, 'name')->textInput(['class' => 'inputForm form-control', 'placeholder' => 'Enter name here.'])->label(false) ?>
    </div>
</div>

<div class="row">

    <div class="col-md-5">
        <div style="text-align: right;">
            <?= Html::resetButton('<li class=\'fa fa-refresh\'></li> Clear', ['class' => 'formBtn btn btn-default btn-sm']) ?>
            <?= Html::submitButton('<li class=\'fa fa-search\'></li> Search', ['class' => 'formBtn btn btn-primary btn-sm']) ?>
        </div>
    </div>

</div>

<?php ActiveForm::end(); ?>

</div>
