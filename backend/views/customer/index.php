<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use kartik\export\ExportMenu;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchCustomer */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
      </div>
      <div class="panel-body">
          <?php echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">List of Customers</h3>
      </div>
      <div class="panel-body">
            <p class="text-right">
                <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
              

            </p>
            <div class="table-responsive">
              <?= GridView::widget([
                  'dataProvider' => $dataProvider,
                  'columns' => [

                      ['class' => 'yii\grid\SerialColumn'],
                      'fullname',
                      'person_in_charge',
                      'job_site:ntext',
                      'address:ntext',
                      'email:email',
                      'contact_no',
                      'phone_no',
                      [
                          'attribute'=>'status',
                          'label' => 'Status',
                          'format' => 'raw',
                          'value' => function($model){
                              return Helper::createActiveLabel($model->status);
                          }
                      ],
              //                'status',
                      // 'race',
                        //  'id',
                    //  'created_at',
                      // 'created_by',
                    //  'updated_at',
                      // 'updated_by',

                      ['class' => 'yii\grid\ActionColumn'],
                  ],
              ]); ?>
            </div>

      </div>
    </div>

</div>
