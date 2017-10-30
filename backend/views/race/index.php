<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchRace */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Races';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="race-index">

    <div class="panel panel-primary">
      <div class="panel-heading">
          <h3 class="panel-title">Search</h3>
      </div>
      <div class="panel-body">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel panel-heading"><span>List of Nationalities</span></div>
        <div class="panel-body">
          <p class="text-right">
              <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
          </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'Name',
                    [
                        'attribute'=>'active',
                        'label'=> 'Status',
                        'format'=> 'raw',
                        'value' => function($model){
                            return Helper::createActiveLabel($model->active);
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                      //    'race_id',
                ],
            ]); ?>
        </div>
    </div>

</div>
