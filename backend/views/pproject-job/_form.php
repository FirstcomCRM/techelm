<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Customer;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Employee;
use common\models\ProjectjobAssignment;
/* @var $this yii\web\View */
/* @var $model common\models\ProjectJob */
/* @var $form yii\widgets\ActiveForm */
$CustomerData = ArrayHelper::map(Customer::find()->all(), 'id', 'fullname'); 
$Status = array(0=>'New');
$projectjobid = $model->find()->orderBy(['id'=> SORT_DESC])->one();
$Inspectors = ArrayHelper::map(User::find()->where(['user_group_id'=> 5])->all(), 'id', 'fullname');
$contructors = ArrayHelper::map(User::find()->where(['user_group_id'=> 6])->all(), 'id', 'fullname');
$Engineers = ArrayHelper::map(User::find()->where(['user_group_id'=> 2])->all(), 'id', 'fullname');
$selectedEngineers = ArrayHelper::map(ProjectjobAssignment::find()->where(['projectjob_id'=> $model->id])->all(), 'engineer_id', 'engineer_id');
?>

<div class="project-job-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Project Job</span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'customer_id')->dropDownList($CustomerData) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($assignment, 'engineer_id[]')            
                             ->dropDownList($Engineers,
                             [
                              'multiple'=> true,
                              'class'=>'chosen-select input-md required',    
                              'required' => '',
                              'value' => $selectedEngineers          
                             ]             
                            )->label("Engineers") 
                    ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'start_date')->textInput(['class'=> 'form-control datepicker', 'readonly'=> true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'first_inspector')->dropDownList($Inspectors) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'second_inspector')->dropDownList($Inspectors) ?>
                </div>
                <div class="col-md-3">
                   <?= $form->field($model, 'third_inspector')->dropDownList($Inspectors) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'status_flag')->dropDownList($Status, ['required'=> '']) ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>Pre installation</span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                   <?= $form->field($model1, 'car_park_code')->textInput(['maxlength' => true, 'required'=> '']) ?> 
                </div>
                <div class="col-md-4">
                    <?= $form->field($model1, 'property_officer')->textInput(['maxlength' => true, 'required'=> '']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model1, 'tc_lew')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                   <?= $form->field($model1, 'property_officer_telNo')->textInput(['maxlength' => true, 'type'=> 'number']) ?> 
                </div>
                <div class="col-md-2">
                   <?= $form->field($model1, 'property_officer_mobileNo')->textInput(['maxlength' => true, 'type'=> 'number']) ?> 
                </div>
                <div class="col-md-4">
                    <?= $form->field($model1, 'property_officer_branch')->textInput(['maxlength' => true, 'required'=> '']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model1, 'tc_lew_email')->textInput(['maxlength' => true, 'required'=> '', 'type'=> 'email']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model1, 'tc_lew_telNo')->textInput(['maxlength' => true, 'type'=> 'number']) ?>
                </div>
                <div class="col-md-2">
                   <?= $form->field($model1, 'tc_lew_mobileNo')->textInput(['maxlength' => true, 'type'=> 'number']) ?> 
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model1, 'remarks')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span>In-site Inspection</span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model3, 'sub_contractor')->dropDownList($contructors) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
    $this->registerJsFile(
        '@web/js/projectjob/custom.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );


 ?>

