<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ServicejobReplacementCategory */

$this->title = 'Create Service Job Replacement Category';
$this->params['breadcrumbs'][] = ['label' => 'Service Job Replacement Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="servicejob-replacement-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
