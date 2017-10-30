<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ServicejobCategories;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobActionServiceRepair */
/* @var $form yii\widgets\ActiveForm */

$data  = ServicejobCategories::find()->select(['id','category'])->all();
$cat = ArrayHelper::map($data, 'id','category');
asort($cat);
?>

<div class="servicejob-action-service-repair-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'servicejob_category_id')->label()->widget(Select2::className(),[
            'data'=>$cat,
            'options'=>['placeholder'=>'Select '],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>

      </div>
      <div class="col-md-3">
        <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

      </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
