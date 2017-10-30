<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ServicejobPrices */

$this->title = 'Update Servicejob Prices: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="servicejob-prices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
