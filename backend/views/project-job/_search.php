<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ProjectJob;
use common\models\Customer;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\SearchProjectJob */
/* @var $form yii\widgets\ActiveForm */

$status = [
  '0'=>'New',
  '1'=>'Pending',
  '2'=>'Completed',
  '3'=>'On-process',
];

$project = ProjectJob::find()->where(['active'=>1])->all();
$proj = ArrayHelper::map($project,'project_ref','project_ref');
asort($proj);

$customer = Customer::find()->where(['active'=>1])->all();
$cust = ArrayHelper::map($customer,'id','fullname');
asort($cust);
?>

<div class="project-job-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'project_ref')->label(false)->widget(Select2::className(),[
            'data'=>$proj,
            'options'=>['placeholder'=>'Project Ref'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'customer_id')->label(false)->widget(Select2::className(),[
            'data'=>$cust,
            'options'=>['placeholder'=>'Customer'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'status_flag')->label(false)->widget(Select2::className(),[
            'data'=>$status,
            'options'=>['placeholder'=>'Status'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>

      </div>
    </div>


    <?php //$form->field($model, 'id') ?>

    <?php //$form->field($model, 'customer_id') ?>

    <?php //$form->field($model, 'start_date') ?>

    <?php //$form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'target_completion_date') ?>

    <?php // echo $form->field($model, 'first_inspector') ?>

    <?php // echo $form->field($model, 'second_inspector') ?>

    <?php // echo $form->field($model, 'third_inspector') ?>


    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('<i class="fa fa-undo" aria-hidden="true"></i> Reset',['index'],['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
