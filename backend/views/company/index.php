<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Company Profile</h3>
      </div>
      <div class="panel-body">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
          // /  'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

              //  'id',
                'company_name',
                'address:ntext',
                'email:email',
                'telephone',
                'fax',
                'website',
                 'postal_code',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
      </div>
    </div>

</div>
