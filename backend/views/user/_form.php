<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\Race;
use common\models\UserGroup;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
$UserGroup = new UserGroup();
$Race = new Race();
$UserGroupData = ArrayHelper::map($UserGroup->find()->where(['active' => 1])->all(), 'id', 'name');
asort($UserGroupData);
$RaceData = ArrayHelper::map($Race->find()->all(), 'Name', 'Name');
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
          <?php echo $form->field($model,'user_group_id')->label()->widget(Select2::className(),[
            'data'=>$UserGroupData,
            'options'=>['placeholder'=>'Select Usergroup'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
        </div>
        <div class="col-md-4">
          <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
          <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
          <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
          <?= $form->field($model, 'active')->dropDownList([1=>'Active', 0=>'Inactive']) ?>
        </div>
        <div class="col-md-4">

        </div>
    </div>

    <div class="">
        <?php echo $form->field($model, 'is_mobile_user')->checkbox() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
