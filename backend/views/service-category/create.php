<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServiceCategory */

$this->title = 'Create Service Category';
$this->params['breadcrumbs'][] = ['label' => 'Service Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
