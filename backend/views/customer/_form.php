<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Race;
use common\models\UserGroup;
/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */


$RaceInfo = ArrayHelper::map(Race::find()->where(['active'=> 1])->all(), 'Name', 'Name');
asort($RaceInfo);
$UserCredentials = Yii::$app->session->get('UserCredentials');
$UserGroup = new UserGroup();
$UserGroupData = ArrayHelper::map($UserGroup->find()->where(['active' => 1])->all(), 'id', 'name');
asort($UserGroupData);

?>

<div class="customer-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'person_in_charge')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email_2')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true, 'type'=> 'number']) ?>
            <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true, 'type'=> 'number']) ?>
            <?= $form->field($model, 'status')->dropDownList([1=>'Active', 0=>'Inactive']) ?>
        </div>
        <div class="col-md-4">

                <?php echo $form->field($model,'race')->label()->widget(Select2::className(),[
                  'data'=>$RaceInfo,
                  'options'=>['placeholder'=>'Select '],
                  'theme'=> Select2::THEME_BOOTSTRAP,
                  'size'=> Select2::MEDIUM,
                  'pluginOptions' => [
                    'allowClear' => true
                  ],
                ]) ?>
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                  <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                <?php echo $form->field($model,'usergroup')->label()->widget(Select2::className(),[
                  'data'=>$UserGroupData,
                  'options'=>['placeholder'=>'Select Usergroup'],
                  'theme'=> Select2::THEME_BOOTSTRAP,
                  'size'=> Select2::MEDIUM,
                  'pluginOptions' => [
                    'allowClear' => true
                  ],
                ]) ?>
                <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
            <?= $form->field($model, 'job_site')->textarea(['rows' => 2]) ?>
              <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
              </div>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>
