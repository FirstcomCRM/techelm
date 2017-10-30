<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Race */

$this->title = 'Update Race: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Races', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->race_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="race-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
