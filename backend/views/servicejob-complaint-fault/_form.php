<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\ServicejobCategories;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobComplaintFault */
/* @var $form yii\widgets\ActiveForm */

$data = ServicejobCategories::find()->all();
$cats = ArrayHelper::map($data,'id','category');
asort($cats);
?>

<div class="servicejob-complaint-fault-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-md-4">
        <?php echo $form->field($model,'servicejob_category_id')->label()->widget(Select2::className(),[
            'data'=>$cats,
            'options'=>['placeholder'=>'Complaint Category'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-4">
        <?= $form->field($model, 'complaint')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-md-4">
        <?= $form->field($model, 'active')->dropDownList(['1' => 'Active', '0' => 'Inactive']) ?>
      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
