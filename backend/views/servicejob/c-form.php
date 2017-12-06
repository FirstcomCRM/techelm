<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
//use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use common\components\Helper;
use common\models\ServicejobComplaintFault;
use common\models\ServicejobCmCf;
use common\models\ServicejobParts;
use common\models\Service;
//$ComplaintRowsCount = isset($rows_count) && $rows_count!=0 ? $rows_count : 1;
//$this->registerAssetBundle(yii\web\JqueryAsset::className(), View::POS_HEAD);


?>

<div class="servicejob-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'], 'id'=>'dynamic-form']); ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Service Job</h3>
      </div>
      <div class="panel-body">

          <div class="row">
            <div class="col-md-6">
              <?= $form->field($model, 'customer_name_2')->textInput()->label('Customer Name') ?>

              <div class="">
                <h3 class="override" style="color:black">Customer Signature</h3>
              </div>
              <div id="signature1">

              </div>
              <!---
              <?php // echo $form->field($model, 'signature_customer_name')->hiddenInput()-> label(false) ?>
              --->

              <?php  echo $form->field($model, 'signature_customer_name')->hiddenInput()->label(false)?>


              <div class="form-group">
                  <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Submit', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary','id'=>'test']) ?>
              </div>
            </div>
          </div>

      </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
