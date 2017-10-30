<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\UserGroup;
/* @var $this yii\web\View */
/* @var $model common\models\SearchUserGroup */
/* @var $form yii\widgets\ActiveForm */
$data = UserGroup::find()->orderBy(['name'=>SORT_ASC])->all();
$group = ArrayHelper::map($data,'name','name');
?>

<div class="user-group-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>
    <div class="row">
      <div class="col-md-3">
        <?php echo $form->field($model,'name')->label(false)->widget(Select2::className(),[
            'data'=>$group,
            'options'=>['placeholder'=>'Usergroup'],
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
