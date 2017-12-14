<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use common\components\Helper;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use common\models\Equipments;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchServicejob */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="reports-index">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search Service Job</h3>
      </div>
      <div class="panel-body">
        <?php  echo $this->render('a_search', ['model' => $searchModel]); ?>
      </div>
    </div>
    <?php if (!empty($dataProvider->getModels() )): ?>
      <div class="row dataprovider">
          <div class="col-md-12">
              <div class="panel panel-primary">
                  <div class="panel-heading"><span>Service Job</span></div>
                  <div class="panel-body">
                    <div class="text-right">
                        <?php echo Html::a('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF',['pdf-a'],['class'=>'btn btn-primary','target'=>'_blank']) ?>
                    </div>
                    <br>
                    <div class="table-responsive">
                      <?= GridView::widget([
                          'dataProvider' => $dataProvider,
                          'columns' => [
                              ['class' => 'yii\grid\SerialColumn'],

                              [
                                'attribute'=>'service_no',
                                'format'=>'raw',
                                'value'=>function($model){
                                  return Html::tag('span', $model->service_no, ['title'=>'Site Address: '.$model->remarks, 'data-toggle'=>'tooltip','data-placement'=>'right']);
                                },
                              ],
                              [
                                  'attribute'=>'customer_id',
                                  'label' => 'Customer Name',
                                  'value' => function($model){
                                      return Helper::retrieveCustomer($model->customer_id);
                                  }
                              ],
                              [
                                'attribute'=>'service_id',
                                'label'=>'Service',
                                'value'=>function($model){
                                  return  Helper::retriveService($model->service_id);
                                },
                              ],

                              [
                                'attribute'=>'engineer_id',
                                'label'=> 'Engineer',
                                'value'=>function($model){
                                  return Helper::retriveUserFull($model->engineer_id);
                                },
                              ],
                              'service_date',

                              [
                                'attribute'=>'equipment_type',
                                'value'=>function($model){
                                  $eq = Equipments::find()->select(['description'])->where(['equipment_code'=> $model->equipment_type])->one();
                                  if (!empty($eq)) {
                                    return $eq->description;
                                  }else {
                                    return $eq = null;
                                  }

                                },
                              ],
                              'serial_no',
                              [
                                  'attribute'=>'status',
                                  'label' => 'Status',
                                  'format' => 'raw',
                                  'value' => function($model){
                                      return Helper::createStatusFlag($model->status);
                                  }
                              ],

                            'remarks:ntext',

                          ],
                      ]); ?>
                    </div>

                  </div>
              </div>
          </div>
      </div>
    <?php endif; ?>




</div>
