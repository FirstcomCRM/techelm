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
//'service_no' => ArrayHelper::map(Service:: find()->where(['active'=> 1])->all(), 'id', 'service_name'),
//'engineer_id' => ArrayHelper::map(User::find()->where(['user_group_id'=> $engineer_group_id])->all(), 'id', 'fullname'),



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
    <?php if ($x=='show'): ?>
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
                          //    'id',
                            //  'service_no',
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
                                      $data = Customer::find()->where(['id'=> $model->customer_id])->one();
                                      if (!empty($data)) {
                                         return $data->fullname;
                                      }

                                  }
                              ],
                              [
                                'attribute'=>'service_id',
                                'label'=>'Service',
                                'value'=>function($model){
                                  $service = Service::find()->where(['id'=>$model->service_id])->one();
                                  if (!empty($service)) {
                                    return $service->service_name;
                                  }else{
                                    return $service = null;
                                  }

                                },
                              ],

                              [
                                'attribute'=>'engineer_id',
                                'label'=> 'Engineer',
                                'value'=>function($model){
                                  $engineer = User::find()->where(['id'=>$model->engineer_id])->one();
                                  if (!empty($engineer)) {
                                      return $engineer->fullname;
                                  }else {
                                      return $engineer = null;
                                  }

                                },
                              ],
                              'service_date',

                              [
                                'attribute'=>'equipment_type',
                                'value'=>function($model){
                                  $eq = Equipments::find()->where(['equipment_code'=> $model->equipment_type])->one();
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
