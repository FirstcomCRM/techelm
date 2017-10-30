<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
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


$excelGrid = [
  ['class' => 'yii\grid\SerialColumn'],
  'id',
  'service_no',
  [
    'attribute'=>'customer_id',
    'label'=>'Customer',
    'value'=>function($model){
      return Helper::retrieveCustomer($model->customer_id);
    }
  ],
  [
    'attribute'=>'service_id',
    'label'=>'Service',
    'value'=>function($model){
      return Helper::retrieveCustomer($model->service_id);
    }
  ],
  [
    'attribute'=>'engineer_id',
    'label'=>'Team',
    'value'=>function($model){
      return Helper::retriveUserFull($model->engineer_id);
    }
  ],
  'service_date',
  'remarks',
  'equipment_type',
  'serial_no',
  [
    'attribute'=>'status',
    'label'=>'Status',
    'format' => 'raw',
    'value'=>function($model){
      return Helper::createStatusFlag($model->status);
    }
  ],
  'date_created',
  [
    'attribute'=>'active',
    'label'=>'Active',
    'format' => 'raw',
    'value'=>function($model){
      return Helper::createActiveLabel($model->active);
    }
  ],
];
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
                  <div class="text-right">
                    <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
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
                    //  'filename'=>'Service Job - '.date('M d Y'),
                      'filename'=>'Service Job - '.date('Y-m-d'),
                      'target'=>ExportMenu::TARGET_SELF,
                      'showConfirmAlert'=>false,
                   ]); ?>
                  </div>
                    <div class="table-responsive">
                      <?= GridView::widget([
                          'dataProvider' => $dataProvider,
                          'columns' => [
                              ['class' => 'yii\grid\SerialColumn'],
                              'id',
                            //  'service_no',
                              [
                                'attribute'=>'service_no',
                                'format'=>'raw',
                                'value'=>function($model){
                                  return Html::a($model->service_no,['servicejob/view','id'=>$model->id],
                                    ['title'=>'Site Address: '.$model->remarks ,'data-toggle'=>'tooltip', 'data-placement'=>'right']
                                  );

                                },
                              ],
                              [
                                  'attribute'=>'customer_id',
                                  'label' => 'Customer Name',
                                //  'format' => 'raw',
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
                             //'engineer_id',
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
                                  'attribute'=>'status',
                                  'label' => 'Status',
                                  'format' => 'raw',
                                  'value' => function($model){
                                      return Helper::createStatusFlag($model->status);
                                  }
                              ],
                              [
                                'attribute'=>'active',
                                'label' => 'State',
                                'format'=>'raw',
                                'value' => function($model){
                                    return Helper::createActiveLabel($model->active);
                                }
                              ],
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

</div>
