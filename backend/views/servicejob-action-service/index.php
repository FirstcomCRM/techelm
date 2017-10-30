<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ServicejobCategories;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ServicejobActionServiceRepairSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Servicejob Action Service Repairs';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
      </div>
      <div class="panel-body">
          <?php echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">List of Service Action</h3>
      </div>
      <div class="panel-body">
        <p class="text-right">
            <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                  'attribute'=>'servicejob_category_id',
                  'label'=>'Service Job Category',
                  'value'=> function($model){
                    return Helper::retriveServiceJobCat($model->servicejob_category_id);
                  }
                ],
                'action',
                ['class' => 'yii\grid\ActionColumn'],

            ],
        ]); ?>
      </div>
    </div>

</div>
