<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DesignatedPosition */

$this->title = 'Update Designated Position';
$this->params['breadcrumbs'][] = ['label' => 'Designated Position List', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update Designated Position';

?>

<div class="row designated-position-update">

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="fa fa-cube"></i> <?= Html::encode($this->title) ?> </h2>

                <div class="box-icon">
                    <?= Html::a( '<i class="fa fa-backward"></i> Previous page', Yii::$app->request->referrer, ['class' => 'btn btn-round btn-default']); ?>
                </div>
            </div>

            <div class="box-content row">
                <div class="col-xs-12 col-md-12 col-sm-12">

                    <div class="contentInfoContainer" >
                         <?= 
                         	$this->render('_form', ['model' => $model ]) 
                         ?>
                    </div>
                
                </div>
            </div>

        </div>
    </div>

</div>
