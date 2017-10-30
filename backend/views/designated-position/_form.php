<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DesignatedPosition */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="designated-position-form">

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="form-label-container">
            <span class="form-label"><li class="fa fa-edit"></li> Designated Position Information.</span>
        </div>
        <br/>

        <div class="col-md-5">
            <label class="formLabel">Name</label>
            <?= $form->field($model, 'name')->textInput(['class' => 'inputForm form-control', 'placeholder' => 'Write name here.', 'id' => 'name' ])->label(false) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label class="formLabel">Description</label>
            <?= $form->field($model, 'description')->textarea(['rows' => '3', 'class' => 'inputForm form-control', 'placeholder' => 'Write description here.', 'id' => 'description' ])->label(false) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
        <hr/>
            <?= Html::submitButton($model->isNewRecord ? '<li class=\'fa fa-save\'></li> Save Record' : '<li class=\'fa fa-save\'></li> Edit Record', ['class' => $model->isNewRecord ? 'formBtn btn btn-primary pull-right btn-sm' : 'form-btn btn btn-primary pull-right btn-sm']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

</div>
<br/>
