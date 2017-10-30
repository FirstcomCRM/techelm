<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SubcontractorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub-Contractors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcontractor-index">

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
        <h3 class="panel-title">List</h3>
      </div>
      <div class="panel-body">
        <p class="text-right">
            <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        <div class="table-repsonsive">
          <?php Pjax::begin(); ?>
             <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                  //  'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'subcontractor',
      
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
          <?php Pjax::end(); ?>
        </div>
      </div>
    </div>


</div>
