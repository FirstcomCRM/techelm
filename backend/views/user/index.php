<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\UserGroup;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchUser */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <?php Yii::$app->session->getFlash('success'); ?>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Search</h3>
      </div>
      <div class="panel-body">
          <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
      </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">List of Users</h3>
      </div>
      <div class="panel-body">
        <p class="text-right">
            <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Add', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        <div class="table-responsive">
          <?= GridView::widget([
              'dataProvider' => $dataProvider,
            //  'filterModel' => $searchModel,
              'columns' => [
                  ['class' => 'yii\grid\SerialColumn'],

                //  'id',
                //  'user_group_id',
                  [
                    'attribute'=>'user_group_id',
                    'value'=>function($model){
                      $group = UserGroup::find()->select('name')->where(['id'=>$model->user_group_id])->one();
                      return $group->name;
                    }
                  ],
                  'fullname',
                  'username',
                  'email:email',
                  'phone_no',
                  [
                      'attribute'=>'active',
                      'label' => 'Status',
                      'format' => 'raw',
                      'value' => function($model){
                          return Helper::createActiveLabel($model->active);
                      }
                  ],
                  // 'password',
                  // 'fax',
                  // 'race',
                  // 'auth_key',
                  // 'password_hash',
                  // 'password_reset_token',
                  // 'photo',
                  // 'status',
                  // 'deleted',
                  // 'created_at',
                  // 'created_by',
                  // 'role',
                  ['class' => 'yii\grid\ActionColumn'],
              ],
          ]); ?>
        </div>

      </div>
    </div>


</div>
