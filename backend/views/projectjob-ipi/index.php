<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchProjectjobIpi */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site Inspection';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-ipi-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span><?php echo Html::encode($this->title); ?></span>
        </div>
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'projectjob_id',
                    'sub_contractor',
                    'sub_c_date',
                    'dispo_by_date',
                    'date_inspected',
                    'form_type',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
    
</div>
