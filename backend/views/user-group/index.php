<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchUserGroup */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-group-index">

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
      <h3 class="panel-title">List of User Group</h3>
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
              'name',
              'description:ntext',
              [
                  'label' => 'Status',
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
