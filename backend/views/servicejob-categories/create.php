<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServicejobCategories */

$this->title = 'Create Servicejob Categories';
$this->params['breadcrumbs'][] = ['label' => 'Servicejob Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-categories-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
