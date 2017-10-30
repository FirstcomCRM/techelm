<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchServiceCategory */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-category-index">

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
        <h3 class="panel-title">List of Service Categories</h3>
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
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
      </div>
    </div>


</div>
