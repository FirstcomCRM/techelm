<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectPii */

$this->title = 'Create Project';
$this->params['breadcrumbs'][] = ['label' => 'Project Pre-Installation Inspection', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row project-pii-create">

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="fa fa-battery"></i> <?= Html::encode($this->title) ?> </h2>

                <div class="box-icon">
                    <?= Html::a( '<i class="fa fa-backward"></i> Previous page', Yii::$app->request->referrer, ['class' => 'btn btn-round btn-default']); ?>
                </div>
            </div>

            <div class="box-content row">
                <div class="col-xs-12 col-md-12 col-sm-12">

                    <div class="contentInfoContainer" >
                         <?= 
                         	$this->render('_form', [
                         			'model' => $model, 
                         			'projectreferenceCode' => $projectreferenceCode, 
                         			'cpCode' => $cpCode 
                         		]) 
                         ?>
                    </div>
                
                </div>
            </div>

        </div>
    </div>

</div>
