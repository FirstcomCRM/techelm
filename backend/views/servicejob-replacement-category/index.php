<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ServicejobReplacementCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Job Replacement Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-replacement-category-index">

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
      <h3 class="panel-title">Replacement Category</h3>
    </div>
    <div class="panel-body">
      <p class="text-right">
          <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
      </p>
      <?= GridView::widget([
          'dataProvider' => $dataProvider,
          //'filterModel' => $searchModel,
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],

            //  'id',
              'category',
              'description:ntext',

              ['class' => 'yii\grid\ActionColumn'],
          ],
      ]); ?>
    </div>
  </div>

</div>
