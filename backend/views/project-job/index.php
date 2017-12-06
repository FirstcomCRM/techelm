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
                  return Helper::retrieveCustomer($model->customer_id);            
                },
              ],
              'start_date',

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

              ['class' => 'yii\grid\ActionColumn'],
          ],
      ]); ?>
    </div>
  </div>


</div>
