<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\SearchToolboxmeeting */
/* @var $form yii\widgets\ActiveForm */

$data = User::find()->select(['id','fullname'])->where(['active'=>1, 'is_mobile_user'=>1])->orderBy(['fullname'=>SORT_ASC])->all();
$engineer = Arrayhelper::map($data,'id','fullname');
?>

<div class="toolboxmeeting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'conducted_by')->dropDownList($engineer,['prompt'=>'Conducted By'])->label(false) ?>

    <div class="form-group">
      <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i> Search', ['class' => 'btn btn-primary']) ?>
      <?php echo Html::a('<i class="fa fa-undo" aria-hidden="true"></i> Reset',['index'],['class'=>'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
