<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UserGroup;
use common\components\Helper;
/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p class="text-right">

        <?php //if (!empty($model->fcm_registered_id)): ?>
          <?php // Html::a('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Logout Mobile', ['clear-fcm', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //endif; ?>

        <?php if ($model->is_mobile_user == 1): ?>
          <?php echo Html::a('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Logout Mobile', ['clear-fcm', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>

        <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          'fullname',
          'username',
            [
              'attribute'=>'user_group_id',
              'value'=>function($model){
                $group = UserGroup::find()->select('name')->where(['id'=>$model->user_group_id])->one();
                return $group->name;
              }
            ],
            'email:email',
            'fax',
            'phone_no',
            'race',
            [
                'attribute'=>'active',
                'label' => 'Status',
                'format' => 'raw',
                'value' => function($model){
                    return Helper::createActiveLabel($model->active);
                }
            ],
            'photo',

        ],
    ]) ?>

</div>
