<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectjobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projectjobs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Projectjob', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'project_ref',
            'customer_id',
            'start_date',
            'end_date',
            // 'targe_completion_date',
            // 'first_inspector',
            // 'second_inspector',
            // 'third_inspector',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
