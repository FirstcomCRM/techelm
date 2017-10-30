<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\UserGroup;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model common\models\SearchUser */
/* @var $form yii\widgets\ActiveForm */

$data = UserGroup::find()->select('id, name')->all();
$group =ArrayHelper::map($data,'id','name');
asort($group);

$data1 =User::find()->orderBy(['fullname'=>SORT_ASC, 'username'=>SORT_ASC])->all();
$full = ArrayHelper::map($data1,'fullname','fullname');
$users = ArrayHelper::map($data1,'username','username');
asort($users);
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
      <div class="col-md-3">
        <?php $form->field($model, 'user_group_id')->dropDownList($group,['prompt'=>'Select UserGroup'])->label(false) ?>
        <?php echo $form->field($model,'user_group_id')->label(false)->widget(Select2::className(),[
            'data'=>$group,
            'options'=>['placeholder'=>'Select Usergroup'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'fullname')->label(false)->widget(Select2::className(),[
            'data'=>$full,
            'options'=>['placeholder'=>'Select Name'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'username')->label(false)->widget(Select2::className(),[
            'data'=>$users,
            'options'=>['placeholder'=>'Select Username'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('<i class="fa fa-undo" aria-hidden="true"></i> Reset',['index'],['class'=>'btn btn-primary']) ?>
        </div>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
