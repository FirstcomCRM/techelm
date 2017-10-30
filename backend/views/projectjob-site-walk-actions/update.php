<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobSiteWalkActions */

$this->title = 'Update Projectjob Site Walk Actions: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Projectjob Site Walk Actions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projectjob-site-walk-actions-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
