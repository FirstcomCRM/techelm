<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobActionServiceRepair */

$this->title = 'Update Servicejob Action Service Repair: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Action Service Repairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->action, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicejob-action-service-repair-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
