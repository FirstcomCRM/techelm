<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Departments */

$this->title = 'View Department';
$this->params['breadcrumbs'][] = ['label' => 'Departments List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row departments-view">

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="fa fa-cube"></i> <?= Html::encode($this->title) ?> </h2>

                <div class="box-icon">
                    <?= Html::a( '<i class="fa fa-backward"></i> Previous page', Yii::$app->request->referrer, ['class' => 'btn btn-round btn-default']); ?>
                    <?= Html::a( '<i class="fa fa-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-round btn-primary']) ?>
                    <?= Html::a( '<i class="fa fa-trash"></i> Delete', ['delete-column', 'id' => $model->id], ['class' => 'btn btn-round btn-danger', 'onclick' => 'return deleteConfirmation()']) ?>
                </div>
            </div>

            <div class="box-content row">
                <div class="col-xs-12 col-md-12 col-sm-12">

                    <div class="contentInfoContainer" >
                         <?= 
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'id',
                                    'name',
                                    'description'
                                ],
                            ]) 
                        ?>
                    </div>
                
                </div>
            </div>

        </div>
    </div>

</div>
