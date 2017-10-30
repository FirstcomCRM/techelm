<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Toolboxmeeting */

$this->title = 'Update Toolboxmeeting: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Toolboxmeetings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="toolboxmeeting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
