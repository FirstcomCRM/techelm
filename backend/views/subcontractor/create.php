<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Subcontractor */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Sub-Contractor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcontractor-create">

    <h1><?php Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
