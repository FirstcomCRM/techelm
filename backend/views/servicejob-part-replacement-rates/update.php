<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobPartReplacementRates */

$this->title = 'Update Servicejob Part Replacement Rates: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Part Replacement Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicejob-part-replacement-rates-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
