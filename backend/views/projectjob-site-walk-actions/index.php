<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectjobSiteWalkActionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projectjob Site Walk Actions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-site-walk-actions-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">List</h3>
      </div>
      <div class="panel-body">
        <p class="text-right">
            <?= Html::a('Add', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
          //  'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'action',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
      </div>
    </div>

</div>
