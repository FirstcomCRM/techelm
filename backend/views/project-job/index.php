<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Customer;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchProjectJob */
/* @var $dataProvider yii\data\ActiveDataProvider */
//$RaceInfo = ArrayHelper::map(Race::find()->where(['active'=> 1])->all(), 'Name', 'Name');
//$UserCredentials = Yii::$app->session->get('UserCredentials');

$this->title = 'Project Jobs';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="project-job-index">

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Search</h3>
    </div>
    <div class="panel-body">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">List Of Projects</h3>
    </div>
    <div class="panel-body">
      <p class="text-right">
          <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
      </p>
      <?= GridView::widget([
          'dataProvider' => $dataProvider,
        //  'filterModel' => $searchModel,
          'columns' => [
               ['class' => 'yii\grid\SerialColumn'],
              'project_ref',
              [
                'attribute'=>'customer_id',
                'label'=>'Customer',
                'value'=>function($model){
                // $data =Customer::find()->where(['id'=>$model->customer_id])->one();

                //  return $data->fullname;
                  return Helper::retrieveCustomer($model->customer_id);
                  //$customer = ArrayHelper::map($data,'id','fullname');
                },
              ],
              'start_date',
          //    'end_date',
              [
                  'attribute'=>'status_flag',
                  'label' => 'Status',
                  'format' => 'raw',
                  'value' => function($model){
                      return Helper::projectStatusFlag($model->status_flag);
                  }

              ],
              [
                  'attribute'=>'active',
                  'label' => 'Active',
                  'format' => 'raw',
                  'value' => function($model){
                      return Helper::createActiveLabel($model->active);
                  }

              ],
              // [
              //     'label'=> 'Action',
              //     'format'=> 'raw',
              //     'value'=> function($model){
              //         return '<a href="?r=projectjob-ipi%2Fcreate&project_job='.$model->id.'">IPIS</a>&nbsp;<a href="?r=projectjob-piss%2Fcreate&project_job='.$model->id.'">PISS</a>';
              //     }
              // ],
              // 'target_completion_date',
              // 'first_inspector',
              // 'second_inspector',
              // 'third_inspector',
              // 'status_flag',

              ['class' => 'yii\grid\ActionColumn'],
          ],
      ]); ?>
    </div>
  </div>


</div>
