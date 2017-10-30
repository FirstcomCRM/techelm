<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Service;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\ServicejobParts */
/* @var $form yii\widgets\ActiveForm */

//$servicejob = new Service();
//$servicejobData = ArrayHelper::map($servicejob->find()->all(), 'id', 'service_name');
$data = Service::find()->select(['id','service_name'])->all();
$service = Arrayhelper::map($data,'id','service_name');
asort($service);

?>

<div class="servicejob-parts-form">
<div class="panel panel-primary">
    <div class="panel-heading">
      <span>Service Job Parts</span>
    </div>
    <div class="panel-body">


        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-4">
              <?php  $form->field($model,'servicejob_id')->label()->widget(Select2::className(),[
                  'data'=>$service,
                  'options'=>['placeholder'=>'Service Job'],
                  'theme'=> Select2::THEME_BOOTSTRAP,
                  'size'=> Select2::MEDIUM,
                  'pluginOptions' => [
                    'allowClear' => true
                  ],
                ]) ?>
                  <?= $form->field($model, 'parts_name')->textInput(['type' => 'text']) ?>
               <?php //$form->field($model, 'servicejob_id')->dropDownlist($servicejobData) ?>
            </div>
            <div class="col-md-4">
                <?php $form->field($model, 'parts_name')->textInput(['type' => 'text']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'required'=> '']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'unit_price')->textInput(['type' =>'number', 'min'=> 0, 'required'=> '']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'total_price')->textInput(['readonly'=> true,'type' => 'number', 'min'=> 0, 'required'=> '']) ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    </div>
</div>

<?php
    $this->registerJsFile(
        '@web/js/servicejobparts/custom.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );


 ?>
