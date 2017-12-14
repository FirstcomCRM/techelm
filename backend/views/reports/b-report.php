<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use common\components\Helper;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use common\models\Servicejob;
use common\models\ServicejobCategories;
use common\models\ServicejobActionServiceRepair;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchServicejob */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;


//echo '<pre>';
//print_r($dataProvider);
//echo '</pre>';
//foreach ($dataProvider as $key => $value) {
//  echo $value['service_no'].'-'.$value['customer_id'].'<br>';
//}
//die('t');
?>


<div class="reports-index">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search Serivce Job Details</h3>
      </div>
      <div class="panel-body">
        <?php  echo $this->render('b-search', ['model' => $searchModel]); ?>
      </div>
    </div>

      <div class="row dataprovider">
          <div class="col-md-12">
              <div class="panel panel-primary">
                  <div class="panel-heading"><span>Service Job Details</span></div>
                  <div class="panel-body">
                    <div class="text-right">
                        <?php echo Html::a('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF',['pdf-b'],['class'=>'btn btn-primary', 'target'=>'_blank']) ?>
                    </div>
                    <br>
                    <div class="table-responsive">
                    
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                          //  'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'service_no',
                                [
                                  'attribute'=>'fullname',
                                  'label'=>'Customer',
                                ],
                                [
                                  'attribute'=>'eng_name',
                                  'label'=>'Engineer',
                                ],
                                'service_date',
                                [
                                  'attribute'=>'status',
                                  'value'=>function($model){
                                    return Helper::retriveStatusFlag($model['status']);
                                  }
                                ],
                                [
                                  'attribute'=>'com_cat',
                                  'label'=>'Service Complaint',
                                ],
                                'complaint_name',
                                [
                                  'attribute'=>'action',
                                  'label'=>'Service Action',
                                ],
                            ],
                        ]); ?>
                    </div>

                  </div>
              </div>
          </div>
      </div>





</div>
