<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchServicejob */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Servicejobs';
$this->params['breadcrumbs'][] = $this->title;
//'service_no' => ArrayHelper::map(Service:: find()->where(['active'=> 1])->all(), 'id', 'service_name'),
//'engineer_id' => ArrayHelper::map(User::find()->where(['user_group_id'=> $engineer_group_id])->all(), 'id', 'fullname'),

?>
<div class="servicejob-index">

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Search</h3>
    </div>
    <div class="panel-body">
      <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><span>Service Job</span></div>
                <div class="panel-body">
                  <p class="text-right">
                      <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
                  </p>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'service_no',
                            [
                                'attribute'=>'customer_id',
                                'label' => 'Customer Name',
                              //  'format' => 'raw',
                                'value' => function($model){
                                    return ArrayHelper::map(Customer::find()->where(['id'=> $model->customer_id])->all(), 'id', 'fullname')[$model->customer_id];
                                }
                            ],
                            [
                              'attribute'=>'service_id',
                              'label'=>'Service',
                              'value'=>function($model){
                                $service = Service::find()->where(['id'=>$model->service_id])->one();
                                return $service->service_name;
                              },
                            ],
                           //'engineer_id',
                            [
                              'attribute'=>'engineer_id',
                              'label'=> 'Engineer',
                              'value'=>function($model){
                                $engineer = User::find()->where(['id'=>$model->engineer_id])->one();
                                return $engineer->fullname;
                              },
                            ],
                            [
                                'attribute'=>'start_date',
                                'label' => 'Date Started',
                                'value' => function($model){
                                    return date('Y-m-d', strtotime($model->start_date));
                                }
                            ],
                            [
                                'attribute'=>'status',
                                'label' => 'Status',
                                'format' => 'raw',
                                'value' => function($model){
                                    return Helper::createStatusFlag($model->status);
                                }
                            ],
                            // 'price_id',
                            // 'complaint:ntext',
                            // 'remarks:ntext',
                            // 'remarks_before:ntext',
                            // 'remarks_after:ntext',
                            // 'equipment_type',
                            // 'serial_no',
                            // 'start_date',
                            // 'end_date',
                            // 'status',
                            // 'locked_to_user',
                            // 'contract_servicing',
                            // 'warranty_servicing',
                            // 'charges',
                            // 'contract_repair',
                            // 'warranty_repair',
                            // 'others',
                            // 'type_of_service',
                            // 'signature_name',
                            // 'start_date_task',
                            // 'end_date_task',
                             [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header'=>'Actions',
                                    'template' => '{update} {delete} {view}',
                                    'buttons' => [
                                      'update'=>function($url,$model){
                                        if($model->status == 1){
                                          return Html::a('<i class="fa fa-pencil-square-o fa-lg grid" aria-hidden="true"></i>',$url, [
                                              'title'=> Yii::t('app','update'),
                                          ]);
                                        }

                                      },
                                        //view button
                                        'view' => function ($url, $model) {
                                            return Html::a('<span class="fa fa-search"></span>View', $url, [
                                                        'title' => Yii::t('app', 'View'),
                                                        'class'=>'btn btn-primary btn-xs',
                                            ]);
                                        },
                                    ],

                           ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

</div>
