<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Equipments */

$this->title = 'Update Equipments: ' . $model->equipment_code;
$this->params['breadcrumbs'][] = ['label' => 'Equipments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="equipments-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
