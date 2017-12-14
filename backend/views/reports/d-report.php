<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use common\components\Helper;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use common\models\Servicejob;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchServicejob */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;

$quantity = 0;
$total = 0;
foreach ($dataProvider->getModels() as $key => $value) {
    $quantity += $value->quantity;
    $total += $value->total_price;
}

$total = number_format($total,2);
$quantity = number_format($quantity);
//die('t');

$excelGrid = [
  ['class' => 'yii\grid\SerialColumn'],
  //'id',
    [
        //'attribute'=>'service_no',
      'label'=>'Service Nos',
      'value'=>function ($model){
        $data = Servicejob::find()->select(['remarks','service_no'])->where(['id'=>$model->servicejob_id])->one();
        if (!empty($data)) {
          return $data->service_no;
        }
        else{
          return $data = null;
        }
      }
    ],
    [
        'attribute'=>'service_date',
        'label'=>'Service Date',
        'value'=>function($model){
          $data = Servicejob::find()->select(['service_date'])->where(['id'=>$model->servicejob_id])->one();
          if (!empty($data) ) {
            return $data->service_date;
          }
          else{
            return $data = null;
          }
        },
    ],
    [
      'attribute'=>'parts_name',
      'format'=>'raw',
    ],

    [
      'attribute'=>'quantity',
      'label'=> 'Quantity_a',
      'footer'=>$quantity,
    ],
    'unit_price',
    [
      'attribute'=>'total_price',
      'label'=> 'Total Price',
      'footer'=>$total,
    ],

];
?>

<div class="reports-index">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search Serivce Job Parts</h3>
      </div>
      <div class="panel-body">
        <?php  echo $this->render('d_search', ['model' => $searchModel]); ?>
      </div>
    </div>
    <?php if (!empty($dataProvider->getModels() )): ?>
      <div class="row dataprovider">
          <div class="col-md-12">
              <div class="panel panel-primary">
                  <div class="panel-heading"><span>Service Job Parts</span></div>
                  <div class="panel-body">
                    <div class="text-right">
                      <?php echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $excelGrid,
                        'fontAwesome' => true,
                        'asDropdown'=>true,
                        'dropdownOptions'=>[
                          'class' => 'btn btn-primary',
                        ],
                        'showColumnSelector'=>true,
                        'columnSelectorOptions'=>[
                          'class'=>'btn btn-primary',
                        ],
                        'exportConfig'=>[
                          ExportMenu::FORMAT_TEXT=>false,
                          ExportMenu::FORMAT_PDF => false,
                          ExportMenu::FORMAT_HTML=>false,
                        ],
                        'filename'=>'Parts Summary - '.date('Y-m-d'),
                        'target'=>ExportMenu::TARGET_SELF,
                        'showConfirmAlert'=>false,
                     ]); ?>
                        <?php echo Html::a('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF',['pdf-d'],['class'=>'btn btn-primary', 'target'=>'_blank']) ?>
                    </div>
                    <br>
                    <div class="table-responsive">
                      <?php
                        echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'showFooter'=>true,
                            'columns'=>[
                              ['class' => 'yii\grid\SerialColumn'],
                              [
                                  'attribute'=>'service_no',
                              //  'label'=>'Service No',
                                'format'=>'raw',
                                'value'=>function ($model){
                                  $data = Servicejob::find()->select(['remarks','service_no'])->where(['id'=>$model->servicejob_id])->one();
                                  if (!empty($data)) {
                                    return Html::tag('span', $data->service_no, ['title'=>'Site Address: '.$data->remarks, 'data-toggle'=>'tooltip','data-placement'=>'right']);
                                  }
                                  else{
                                    return $data = null;
                                  }
                                }
                              ],
                              [
                                  'attribute'=>'service_date',
                                  //'label'=>'Service Date',
                                  'value'=>function($model){
                                    $data = Servicejob::find()->select(['service_date'])->where(['id'=>$model->servicejob_id])->one();
                                    if (!empty($data) ) {
                                      return $data->service_date;
                                    }
                                    else{
                                      return $data = null;
                                    }
                                  },
                              ],
                            //  'service.id',
                              'parts_name',
                              [
                                'attribute'=>'quantity',
                                'label'=> 'Quantity',
                                'footer'=>$quantity,
                              ],
                              'unit_price',
                            //  'total_price',
                              [
                                'attribute'=>'total_price',
                                'label'=> 'Total Price',
                                'footer'=>$total,
                              ],

                            ],
                        ])
                       ?>
                    </div>

                  </div>
              </div>
          </div>
      </div>

   <?php endif; ?>

</div>
