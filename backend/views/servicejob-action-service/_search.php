<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ServicejobCategories;
use common\models\ServicejobActionServiceRepair;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobActionServiceRepairSearch */
/* @var $form yii\widgets\ActiveForm */

$data  = ServicejobCategories::find()->select(['id','category'])->all();
$cat = ArrayHelper::map($data, 'id','category');
asort($cat);

$data = ServicejobActionServiceRepair::find()->select(['action'])->distinct()->all();
$action = ArrayHelper::map($data, 'action','action');

$arrange = [
  'SORT_DESC'=>'Descending',
  'SORT_ASC'=>'Ascending'
]
?>

<div class="servicejob-action-service-repair-search">



    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'servicejob_category_id')->label(false)->widget(Select2::className(),[
            'data'=>$cat,
            'options'=>['placeholder'=>'Service Category '],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>

      <div class="col-md-3">
        <?php echo $form->field($model,'action')->label(false)->widget(Select2::className(),[
            'data'=>$action,
            'options'=>['placeholder'=>'Action '],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>

      <div class="col-md-3">
        <?php echo $form->field($model,'arrange')->dropDownList($arrange, ['prompt'=>'Sort Action'])->label(false) ?>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('<i class="fa fa-undo" aria-hidden="true"></i> Reset',['index'],['class'=>'btn btn-primary']) ?>
        </div>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
