<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServicejobPrices */

$this->title = 'Create Servicejob Prices';
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-prices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
