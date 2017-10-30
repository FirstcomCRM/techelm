<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\ServicejobCategories;
use common\models\ServicejobComplaintFault;
/* @var $this yii\web\View */
/* @var $model common\models\SearchServicejobComplaintFault */
/* @var $form yii\widgets\ActiveForm */

$data = ServicejobCategories::find()->all();
$cats = ArrayHelper::map($data,'id','category');
asort($cats);

$data1 = ServicejobComplaintFault::find()->all();
$comp = ArrayHelper::map($data1,'complaint','complaint');
asort($comp);
?>

<div class="servicejob-complaint-fault-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'servicejob_category_id')->label(false)->widget(Select2::className(),[
            'data'=>$cats,
            'options'=>['placeholder'=>'Complaint Category'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'complaint')->label(false)->widget(Select2::className(),[
            'data'=>$comp,
            'options'=>['placeholder'=>'Complaint Category'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
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
