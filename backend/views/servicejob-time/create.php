<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServicejobTime */

$this->title = 'Create Servicejob Time';
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Times', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-time-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
