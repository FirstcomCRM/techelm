<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;
use common\models\ProjectJob;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchToolboxmeeting */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Toolbox Meeting';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="toolboxmeeting-index">

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

      </div>
      <div class="panel-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                 ['class' => 'yii\grid\SerialColumn'],

                'site_address',
                'date_added',
                'meeting_details',
                [
                  'attribute'=>'conducted_by',
                  'value'=>function($model){
                    return Helper::retriveUserFull($model->conducted_by);
                  },
                ],
                

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
      </div>
    </div>

</div>
