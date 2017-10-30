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
asort($service_no);
asort($customer_no);
asort($engineer_id);
asort($equipments);
asort($service_categories);

$data = Service::find()->select(['service_name'])->orderBy(['service_name'=>SORT_ASC])->all();
$serv = ArrayHelper::map($data, 'service_name','service_name');

$logic = false;
$url = \yii\helpers\Url::to(['test']);
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
                    'options'=>['placeholder'=>'Customer', 'id'=>'customer_test',
                       /* 'onchange'=>'$.post("'.url::to(['servicejob/get-address','id'=>'']).
                          '"+$(this).val(),function( data )
                            {
                              $("#site_address").html( data );
                            });'*/
                      ],
                    'theme'=> Select2::THEME_BOOTSTRAP,
                    'size'=> Select2::MEDIUM,
                    'pluginOptions' => [
                      'allowClear' => true,
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
                      'allowClear' => true,

                    ],
                  ]) ?>

                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'serial_no')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'service_date')->textInput(['maxlength' => true, 'class'=>'form-control datepicker','readonly'=>true]) ?>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                     <?= $form->field($model, 'remarks')->textarea(['rows' => 6, 'id'=>'site_address']) ?>
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
            //    'deleteButton' => '.add-item', // css class
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
                              $logic = true;
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

                        </td>
                        <td>

                          <?php echo $form->field($line, "[{$i}]complaint_id")->label(false)->widget(DepDrop::className(),[
                            'options'=>['id'=>'subcat-'.$i.'-id' ,'placeholder'=>'Select...'],
                        //    'type'=>2,
                            'type' => DepDrop::TYPE_SELECT2,
                            //'data'=>[$line->servicejob_category_id => $line->complaint_id],
                            'data'=>[$line->complaint_id =>  $line->complaint_name],
                            'select2Options'=>['pluginOptions'=>['allowClear'=>true],'size'=> Select2::MEDIUM,'theme'=> Select2::THEME_BOOTSTRAP],
                            'pluginOptions'=>[
                              'depends'=>['cat-'.$i.'-id'],
                              'initDepends'=>['cat-'.$i.'-id'],
                            //  'placeholder'=>'Select...',
                          //    'placeholder'=>false,
                              //'initialize'=>false,
                            //    'initialize'=>true,
                          //      'loading'=>true,
                            'loading'=>false,
                              'url'=>Url::to(['/servicejob/fetch-complaints']),

                            ],
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




    <?php
      $found = ServicejobParts::find()->where(['servicejob_id'=>$model->id])->one();
      if (empty($found)) {
          $found = null;
      }
     ?>
    <?php if ($found!=null): ?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Part List</h3>
        </div>
        <div class="panel-body">
            <?php Pjax::begin(); ?>
          <?= GridView::widget([
              'dataProvider' =>$modelParts,
          //    'filterModel' => $searchModel,
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],
                //    'id',
              //      'servicejob_id',
                    /*[
                    'attribute'=>'servicejob_id',
                    'label'=> 'Service Job',
                    'value'=>function ($model){

                        return Helper::retriveService($model->servicejob_id);

                    },
                  ],*/
                  'parts_name:ntext',
                  'quantity:ntext',

                  [
                    'attribute'=>'unit_price',
                    'label'=> 'Unit Price',
                    'value'=> function($model){
                      return number_format($model->unit_price,2);
                    },
                  ],
                   [
                     'attribute'=>'total_price',
                     'label'=> 'Total Price',
                     'value'=> function($model){
                       return number_format($model->total_price,2);
                     },
                   ],

                  [
                    'attribute'=>'date_added',
                    'label'=> 'Date',
                  ],

                  [
                    'header'=>'Action',
                    'headerOptions'=>['width'=>100],
                    'class'=>'yii\grid\ActionColumn',
                    'template'=>'{update}{delete}',
                    'buttons'=>[
                        'update'=>function($url,$model){
                            return Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> ',$url,['id'=>$model->id, 'title'=>Yii::t('app','Update'), 'data-pjax'=>0,'target'=>'_blank'

                          ]);
                        },
                        'delete'=>function($url,$model){
                            return Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i> ',$url,['id'=>$model->id, 'title'=>Yii::t('app','Delete'), 'data-pjax'=>0,
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                          ]);
                        },
                    ],
                    'urlCreator'=>function($action,$model,$key,$index){
                      if($action==='view'){
                        $url ='?r=servicejob-parts%2Fview&id='.$model->id;
                        return $url;
                      }
                      if($action==='update'){
                        $url ='?r=servicejob-parts%2Fupdate&id='.$model->id;
                        return $url;
                      }
                      if($action==='delete'){
                        $url ='?r=servicejob-parts%2Fdelete&id='.$model->id;
                        return $url;
                      }
                    }
                  ],
              ],
          ]); ?>
            <?php Pjax::end(); ?>
        </div>
      </div>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
