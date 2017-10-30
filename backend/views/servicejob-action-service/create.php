<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServicejobActionServiceRepair */

$this->title = 'Create Servicejob Action Service Repair';
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Action Service Repairs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-action-service-repair-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
