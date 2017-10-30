<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchProjectjobPiss */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pre-installations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-piss-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading"><span><?= Html::encode($this->title) ?></span></div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'projectjob_id',
                    'car_park_code',
                    'property_officer',
                    'tc_lew',
                    // 'property_officer_telNo',
                    // 'property_officer_mobileNo',
                    // 'property_officer_branch',
                    // 'tc_lew_telNo',
                    // 'tc_lew_mobileNo',
                    // 'tc_lew_email:email',
                    // 'remarks:ntext',
                    // 'date_site_walk',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
   
</div>
