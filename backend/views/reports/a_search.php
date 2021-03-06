<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use common\models\Servicejob;
use common\models\ServicejobCategories;
use common\models\ServicejobComplaintFault;


$data = Customer::find()->select(['id','fullname'])->where(['active'=>1])->all();
$customer = ArrayHelper::map($data,'id','fullname');
asort($customer);

$data = Service::find()->where(['active'=>1])->select(['id','service_name'])->all();
$service = ArrayHelper::map($data,'id','service_name');
asort($service);

$data = User::find()->where(['user_group_id'=>2, 'active'=>1])->select(['id','fullname'])->all();
$engineer = ArrayHelper::map($data,'id','fullname');
asort($engineer);

$data = Servicejob::find()->select(['service_no'])->where(['active'=>1])->all();
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

$active = [
  0=>'Inactive',
  1=>'Active'
];

?>

<div class="servicejob-search">

    <?php $form = ActiveForm::begin([
        'action' => ['report-a'],
        'method' => 'get',
    //   'method' => 'post',
    ]); ?>

    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'service_no')->label(false)->widget(Select2::className(),[
            'data'=>$job_no,
            'options'=>['placeholder'=>'Service No '],
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
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'active')->label(false)->widget(Select2::className(),[
            'data'=>$active,
            'options'=>['placeholder'=>'State '],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'service_date')->label(false)->widget(DateRangePicker::classname(), [
          'useWithAddon'=>false,
          'convertFormat'=>true,
          'pluginOptions'=>[
            'locale'=>[
              //'format'=> 'M j Y',
              //'format'=> 'm-d-Y',
              'format'=> 'Y-m-d',
            ],
          ],
          'options'=>[
            'placeholder'=>'Service Date',
            'class'=>'form-control'
          ],
        ]); ?>
    </div>

      <div class="col-md-3">
        <?php echo $form->field($model, 'remarks')->textInput(['placeholder'=>'Site Address'])->label(false) ?>
      </div>
      <div class="col-md-3">
        <!--Add filter by year-->

        <?php  echo $form->field($model, 'year')->textInput(['placeholder'=>'Year'])->label(false) ?>
      </div>

      <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary', 'id'=>'search']) ?>
            <?php echo Html::a('<i class="fa fa-undo" aria-hidden="true"></i> Reset',['report-a'],['class'=>'btn btn-primary']) ?>
        </div>
      </div>

    </div>
      <?php ActiveForm::end(); ?>
</div>
