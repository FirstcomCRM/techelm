<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\components\Helper;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model common\models\ProjectJob */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Project Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="project-job-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
      
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Project Job</span>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'project_ref',
                    'customer_id',
                    'start_date',
                    'end_date',
                    'target_completion_date',
                    'first_inspector',
                    'second_inspector',
                    'third_inspector',
                    [
                        'label' => 'Status',
                        'format' => 'raw',
                        'value' => function($model){
                            return Helper::createStatusFlag($model->status_flag);
                        }
                    ]
                    // 'status_flag',

                ],
            ]) ?>
        </div>
    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Pre Installation</span>
        </div>
        <div class="panel-body">
            <?php echo GridView::widget([
                'dataProvider'=> $PissJoinTask,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    // 'id',
                    // 'projectjob_id',
                    'car_park_code',
                    'property_officer',
                    'tc_lew',
                    'tc_lew_mobileNo'
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Site Inspection</span>
        </div>
        <div class="panel-body">
            <?php echo GridView::widget([
                'dataProvider'=> $ProjectJobIpiData,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    // 'id',
                    // 'projectjob_id',
                    // 'sub_contractor',
                    [
                        'label' => 'Contractor',
                        'format' => 'raw',
                        'value' => function($model){
                            return User::find()->select('fullname')->where(['id' => $model->sub_contractor])->one()['fullname'];
                        }
                    ],

                    'form_type'
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading"><span>Engineers</span></div>
        <div class="panel-body">
            <?php echo GridView::widget([
                'dataProvider'=> $engineers,
                'columns' => [
                'id',
                    [
                        'label' => 'Fullname',
                        'format'=> 'raw',
                        'value' => function($model){
                            return User::find()->select(['fullname'])->where(['id'=> $model->engineer_id])->one()['fullname'];
                        }
                    ],
                    [
                        'label' => 'Email',
                        'format'=> 'raw',
                        'value' => function($model){
                            return User::find()->select(['email'])->where(['id'=> $model->engineer_id])->one()['email'];
                        }
                    ],
                    'date_created'
                ]
            ]);
            ?>
        </div>
    </div>


</div>
