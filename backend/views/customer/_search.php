<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Customer;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\SearchCustomer */
/* @var $form yii\widgets\ActiveForm */

$cust = Customer::find()->all();
$full = ArrayHelper::map($cust,'fullname','fullname');
asort($full);
$person =  ArrayHelper::map($cust,'person_in_charge','person_in_charge');
asort($person)
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
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
        <?php $form->field($model, 'fullname')->textInput(['placeholder'=>'Enter Name'])->label(false) ?>
      </div>
      <div class="col-md-3">
        <?php echo $form->field($model,'person_in_charge')->label(false)->widget(Select2::className(),[
            'data'=>$person,
            'options'=>['placeholder'=>'Select Person in charge'],
            'theme'=> Select2::THEME_BOOTSTRAP,
            'size'=> Select2::MEDIUM,
            'pluginOptions' => [
              'allowClear' => true
            ],
          ]) ?>
        <?php $form->field($model, 'person_in_charge')->textInput(['placeholder'=>'Enter Person in Charge'])->label(false) ?>
      </div>
      <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
            <?php echo Html::a('<i class="fa fa-undo" aria-hidden="true"></i> Reset',['index'],['class'=>'btn btn-primary']) ?>
        </div>
      </div>
    </div>

    <?php // $form->field($model, 'id') ?>
    <?php // $form->field($model, 'address') ?>
    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'contact_no') ?>

    <?php // echo $form->field($model, 'phone_no') ?>

    <?php // echo $form->field($model, 'race') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>



    <?php ActiveForm::end(); ?>

</div>
