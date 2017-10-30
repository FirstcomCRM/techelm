<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchDepartments */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments List';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn',
            'options' => [ 'style' => 'background-color: #E6E6E7' ]
        ],
            [
                'label' => 'Name',
                'value' => 'name',
                'options' => [ 'style' => 'background-color: #E6E6E7' ]
            ],
            [
                'label' => 'Description',
                'value' => 'description',
                'options' => [ 'style' => 'background-color: #E6E6E7' ]
            ],
        [
            'options' => [ 'style' => 'background-color: #E6E6E7' ],
            'header' => 'Action',
            'class' => 'yii\grid\ActionColumn',
            'template' => '{preview}{update}{delete}',
            'buttons' => [
                'preview' => function ($url, $model) {
                    return Html::a(' <span class="glyphicon glyphicon-eye-open"></span> ', $url, ['id' => $model->id, 'title' => Yii::t('app', 'Preview'),
                    ]);
                },
                'update' => function ($url, $model) {
                    return Html::a(' <span class="glyphicon glyphicon-pencil"></span> ', $url, ['id' => $model->id, 'title' => Yii::t('app', 'Update'),
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a(' <span class="glyphicon glyphicon-trash"></span> ', $url, ['onclick' => 'return deleteConfirmation()', 'id' => $model->id, 'title' => Yii::t('app', 'Delete'),
                    ]);
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'preview') {
                    $url ='?r=departments/view&id='.$model->id;
                    return $url;
                }   
                if ($action === 'update') {
                    $url ='?r=departments/update&id='.$model->id;
                    return $url;
                }
                if ($action === 'delete') {
                    $url ='?r=departments/delete-column&id='.$model->id;
                    return $url;
                }
            }
        ],
    ]
?>

<div class="row departments-index">

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="fa fa-cube"></i> <?= Html::encode($this->title) ?> </h2>

                <div class="box-icon">
                    <a href="?r=departments/create" class="btn btn-round btn-default">
                        <i class="glyphicon glyphicon-plus"></i> <b>New</b>
                    </a>
                </div>
            </div>

            <div class="box-content row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    
                    <div class="searchboxAlignment" >
                        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                    </div>
                    <hr/>

                    <div class="contentInfoContainer" >
                        <div class="table table-responsive">
                            <?=
                                GridView::widget([
                                    'id' => 'tableID',
                                    'class' => 'table table-hover',
                                    'dataProvider' => $dataProvider,
                                    'columns' => $gridColumns,
                                ]); 
                            ?>
                        </div>
                    </div>
                
                </div>
            </div>
            
        </div>
    </div>

</div>
