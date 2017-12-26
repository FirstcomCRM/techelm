<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\ToolboxmeetingAttendees;
/* @var $this yii\web\View */
/* @var $model common\models\Toolboxmeeting */
/* @var $form yii\widgets\ActiveForm */

$data = User::find()->select(['id','fullname'])->where(['active'=>1, 'is_mobile_user'=>1])->orderBy(['fullname'=>SORT_ASC])->all();
$engineer = Arrayhelper::map($data,'id','fullname');
?>

<div class="toolboxmeeting-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-md-6">
        <?= $form->field($model, 'site_address')->textInput() ?>

        <?= $form->field($model, 'date_added')->textInput(['maxlength' => true, 'readOnly'=>true]) ?>

        <?php $form->field($model, 'conducted_by')->textInput(['maxlength' => true]) ?>
        <?php echo $form->field($model, 'conducted_by')->dropDownList($engineer) ?>
        <p>insert list of attendess here</p>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
      </div>
      <div class="col-md-6">
        <label for="test" class="control-label">Meeting Image</label><br>
        <?php if (!empty($model->meeting_image)): ?>
          <?php $path =  Yii::getAlias('@api-main').ltrim($model->meeting_image,'.'); ?>
          <img src="<?php echo $path ?>" alt="" class="img-responsive" style="width:50%; height:auto">
        <?php else: ?>
          print No image
        <?php endif; ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
