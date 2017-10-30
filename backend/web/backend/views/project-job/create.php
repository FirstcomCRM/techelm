<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Projectjob */

$this->title = 'Create Projectjob';
$this->params['breadcrumbs'][] = ['label' => 'Projectjobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projectjob-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
