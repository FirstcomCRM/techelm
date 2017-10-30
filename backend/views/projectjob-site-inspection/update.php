<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobSiteInspection */

$this->title = 'Site In-process Inspection: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Site In-process Inspection', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projectjob-site-inspection-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
