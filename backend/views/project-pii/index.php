<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchProjectPii */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Pre-Installation Inspection';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn',
            'options' => [ 'style' => 'background-color: #E6E6E7' ]
        ],
            [
                'label' => 'Project Reference',
                'value' => 'project_reference',
                'options' => [ 'style' => 'background-color: #E6E6E7' ]
            ],
            [
                'label' => 'CP Code',
                'value' => 'cp_code',
                'options' => [ 'style' => 'background-color: #E6E6E7' ]
            ],
            [
                'label' => 'Date Site-Walk',
                'value' => 'date_sitewalk',
                'options' => [ 'style' => 'background-color: #E6E6E7' ]
            ],
            [
                'label' => 'Attended By',
                'value' => 'attended_by',
                'options' => [ 'style' => 'background-color: #E6E6E7' ]
            ],
            [
                'label' => 'Status',
                'value' => 'project_condition',
                'options' => [ 'style' => 'background-color: #E6E6E7;' ]
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
                    $url ='?r=project-pii/view&id='.$model->id;
                    return $url;
                }   
                if ($action === 'update') {
                    $url ='?r=project-pii/update&id='.$model->id;
                    return $url;
                }
                if ($action === 'delete') {
                    $url ='?r=project-pii/delete-column&id='.$model->id;
                    return $url;
                }
            }
        ],
    ]
?>

<div class="row project-pii-index">

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="fa fa-map"></i> <?= Html::encode($this->title) ?> </h2>

                <div class="box-icon">
                    <a href="?r=project-pii/create" class="btn btn-round btn-default">
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
