<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use common\models\Servicejob;
/* @var $this yii\web\View */
/* @var $model common\models\SearchServicejob */
/* @var $form yii\widgets\ActiveForm */
//return ArrayHelper::map(Customer::find()->where(['id'=> $model->customer_id])->all(), 'id', 'fullname')[$model->customer_id];

$data = Customer::find()->select(['id','fullname'])->all();
$customer = ArrayHelper::map($data,'id','fullname');
asort($customer);

$data = Service::find()->select(['id','service_name'])->all();
$service = ArrayHelper::map($data,'id','service_name');
asort($service);

$data = User::find()->where(['user_group_id'=>2])->select(['id','fullname'])->all();
$engineer = ArrayHelper::map($data,'id','fullname');
asort($engineer);

$data = Servicejob::find()->select(['service_no'])->all();
$job_no = ArrayHelper::map($data,'service_no','service_no');
asort($job_no);

$data = null;
$status = [
  0 => 'New',
  1=>'Unsigned',
  2=>'Pending',
  3=>'Completed',
  4=>'On Process',
];
?>

<div class="servicejob-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'service_no')->label(false)->widget(Select2::className(),[
            'data'=>$job_no,
            'options'=>['placeholder'=>'Customer '],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
        </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'customer_id')->label(false)->widget(Select2::className(),[
            'data'=>$customer,
            'options'=>['placeholder'=>'Customer '],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'service_id')->label(false)->widget(Select2::className(),[
            'data'=>$service,
            'options'=>['placeholder'=>'Service '],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'engineer_id')->label(false)->widget(Select2::className(),[
            'data'=>$engineer,
            'options'=>['placeholder'=>'Engineer '],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'status')->label(false)->widget(Select2::className(),[
            'data'=>$status,
            'options'=>['placeholder'=>'Status '],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
        <?php $form->field($model, 'status')->dropDownList($status,['prompt'=>'Select Status'])->label(false) ?>
      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-undo" aria-hidden="true"></i> Reset', ['class' => 'btn btn-primary ']) ?>
    </div>


    <?php // echo $form->field($model, 'price_id') ?>

    <?php // echo $form->field($model, 'complaint') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'remarks_before') ?>

    <?php // echo $form->field($model, 'remarks_after') ?>

    <?php // echo $form->field($model, 'equipment_type') ?>

    <?php // echo $form->field($model, 'serial_no') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'locked_to_user') ?>

    <?php // echo $form->field($model, 'contract_servicing') ?>

    <?php // echo $form->field($model, 'warranty_servicing') ?>

    <?php // echo $form->field($model, 'charges') ?>

    <?php // echo $form->field($model, 'contract_repair') ?>

    <?php // echo $form->field($model, 'warranty_repair') ?>

    <?php // echo $form->field($model, 'others') ?>

    <?php // echo $form->field($model, 'type_of_service') ?>

    <?php // echo $form->field($model, 'signature_name') ?>

    <?php // echo $form->field($model, 'start_date_task') ?>

    <?php // echo $form->field($model, 'end_date_task') ?>



    <?php ActiveForm::end(); ?>

</div>
