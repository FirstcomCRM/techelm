<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Url;
use common\models\ServicejobComplaintFault;
use common\models\ServicejobCmCf;
//$ComplaintRowsCount = isset($rows_count) && $rows_count!=0 ? $rows_count : 1;
//$this->registerAssetBundle(yii\web\JqueryAsset::className(), View::POS_HEAD);
asort($service_no);
asort($customer_no);
asort($engineer_id);
asort($equipments);
asort($service_categories);


?>


<div class="servicejob-form">

  
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'], 'id'=>'dynamic-form']); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Service Job</span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                  <?php echo $form->field($model,'service_id')->label()->widget(Select2::className(),[
                    'data'=>$service_no,
                    'options'=>['placeholder'=>'Service Category '],
                    'theme'=> Select2::THEME_BOOTSTRAP,
                    'size'=> Select2::MEDIUM,
                    'pluginOptions' => [
                      'allowClear' => true
                    ],
                  ]) ?>
                </div>
                <div class="col-md-2">
                  <?php echo $form->field($model,'customer_id')->label()->widget(Select2::className(),[
                    'data'=>$customer_no,
                    'options'=>['placeholder'=>'Customer'],
                    'theme'=> Select2::THEME_BOOTSTRAP,
                    'size'=> Select2::MEDIUM,
                    'pluginOptions' => [
                      'allowClear' => true
                    ],
                  ]) ?>
                </div>
                <div class="col-md-2">
                  <?php echo $form->field($model,'engineer_id')->label()->widget(Select2::className(),[
                    'data'=>$engineer_id,
                    'options'=>['placeholder'=>'Team'],
                    'theme'=> Select2::THEME_BOOTSTRAP,
                    'size'=> Select2::MEDIUM,
                    'pluginOptions' => [
                      'allowClear' => true
                    ],
                  ]) ?>
                </div>
                <div class="col-md-2">
                  <?php echo $form->field($model,'equipment_type')->label()->widget(Select2::className(),[
                    'data'=>$equipments,
                  //  'options'=>['placeholder'=>'Team'],
                    'theme'=> Select2::THEME_BOOTSTRAP,
                    'size'=> Select2::MEDIUM,
                    'pluginOptions' => [
                      'allowClear' => true
                    ],
                  ]) ?>

                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'serial_no')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                     <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
    </div>



    <div class="panel panel-primary">
        <div class="panel-heading"><span>Complaints</span></div>
        <div class="panel-body">
          <?php DynamicFormWidget::begin([
              'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
              'widgetBody' => '.container-items', // required: css class selector
              'widgetItem' => '.item', // required: css class
              'limit' => 50, // the maximum times, an element can be cloned (default 999)
              'min' => 1, // 0 or 1 (default 1)
              'insertButton' => '.add-item', // css class
              'deleteButton' => '.remove-item', // css class
              'model' => $modelComplaints[0],
              'formId' => 'dynamic-form',
              'formFields' => [
                  'servicejob_category_id',
                  'complaint_id',
                  'active',
              ],
          ]); ?>


            <table class="table table-responsive table-bordered container-items">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Complaints</th>
                        <th>Remark</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach ($modelComplaints as $i => $line): ?>
                    <tr class="item">
                        <?php
                          if (!$line->isNewRecord) {
                              echo Html::activeHiddenInput($line, "[{$i}]id");
                          }
                        ?>
                        <td>
                          <?php echo $form->field($line,"[{$i}]servicejob_category_id")->label(false)->widget(Select2::className(),[
                            'data'=>$service_categories,
                            'options'=>['placeholder'=>'Select', 'class'=>'service_category form-control', 'id'=>'cat-'.$i.'-id'],
                            'theme'=> Select2::THEME_BOOTSTRAP,
                            'size'=> Select2::MEDIUM,
                            'pluginOptions' => [
                              'allowClear' => true,
                           ],
                          ]) ?>
                          <?php  $form->field($line, "[{$i}]servicejob_category_id")->dropDownList($service_categories, ['class'=> 'service_category form-control', 'id'=>'cat-'.$i.'-id','prompt'=>'Select'])
                          ->label(false); ?>
                        </td>
                        <td>
                          <?php $form->field($line, "[{$i}]complaint_id")->textInput()->label(false) ?>
                          <?php echo $form->field($line, "[{$i}]complaint_id")->label(false)->widget(DepDrop::className(),[
                            'options'=>['id'=>'subcat-'.$i.'-id'],
                            'type'=>2,

                            //'data'=>[$line->servicejob_category_id => $line->complaint_id],
                            'data'=>[$line->complaint_id =>  $line->complaint_name],
                            'select2Options'=>['pluginOptions'=>['allowClear'=>true],'size'=> Select2::MEDIUM,'theme'=> Select2::THEME_BOOTSTRAP,],
                            'pluginOptions'=>[
                              'depends'=>['cat-'.$i.'-id'],
                              //'placeholder'=>'Select...',
                              'initialize'=>false,
                              'url'=>Url::to(['/servicejob/fetch']),

                              ]
                          ]);  ?>
                        </td>
                        <td>
                          <?= $form->field($line, "[{$i}]complaint_remark")->textArea()->label(false) ?>
                        </td>
                        <td>
                          <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                          <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
              <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
