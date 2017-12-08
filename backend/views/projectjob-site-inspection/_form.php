<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ProjectJob;
use common\models\Subcontractor;
use common\models\User;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectjobSiteInspection */
/* @var $form yii\widgets\ActiveForm */
$field = [
  'EPS'=>'EPS',
  'PW'=>'PW',
];

$data = User::find()->where(['is_mobile_user'=>1, 'active'=>1])->orderBy(['fullname'=>SORT_ASC])->all();
$eng = ArrayHelper::map($data,'id','fullname');

$data = Subcontractor::find()->all();
$subcon = ArrayHelper::map($data,'id','subcontractor');

$data = Customer::find()->where(['active'=>1])->all();
$proj_ref = ArrayHelper::map($data,'id','fullname');
?>

<div class="projectjob-site-inspection-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-md-4">
        <?php echo $form->field($model,'field_type')->dropDownList($field) ?>
        <?php echo $form->field($model,'project_ref')->dropDownList($proj_ref) ?>
        <?= $form->field($model, 'date_inspection')->textInput(['class'=> 'form-control datepicker', 'readonly'=> true]) ?>

      </div>
      <div class="col-md-4">
          <?= $form->field($model, 'work_completion_start_date')->textInput(['class'=> 'form-control datepicker', 'readonly'=> true]) ?>
          <?= $form->field($model, 'work_completion_end_date')->textInput(['class'=> 'form-control datepicker', 'readonly'=> true]) ?>
          <?php echo $form->field($model,'project_site')->textArea(['rows' => 3]) ?>
      </div>
      <div class="col-md-4">
        <?php echo $form->field($model,'inspected_by')->dropDownList($eng) ?>
        <?php echo $form->field($model,'subcontractor')->dropDownList($subcon) ?>

      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update',
        ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
