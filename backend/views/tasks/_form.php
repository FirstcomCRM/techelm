<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\TaskCategory;

$dataTaskCategory = ArrayHelper::map(TaskCategory::find()->where(['status' => 1])->all(),'id', 'name');
/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tasks-form">

<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="form-label-container">
            <span class="form-label"><li class="fa fa-edit"></li> Tasks Information.</span>
        </div>
        <br/>

        <div class="col-md-4">
            <label class="formLabel">Task Category</label>
            <?= $form->field($model, 'task_category_id')->dropdownList(['0' => '- PLEASE SELECT CATEGORY HERE -'] + $dataTaskCategory, ['class' => '', 'id' => 'selectError', 'data-rel' => 'chosen', 'style' => 'width: 100%;', 'data-placeholder' => 'CHOOSE TASK CATEGORY HERE'])->label(false) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <label class="formLabel">Task Code</label>
            <?= $form->field($model, 'tasks_code')->textInput(['class' => 'inputForm form-control', 'value' => $tasksCode, 'id' => 'tasksCode', 'readonly' => 'readonly' ])->label(false) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <label class="formLabel">Task Name</label>
            <?= $form->field($model, 'tasks_name')->textInput(['class' => 'inputForm form-control', 'placeholder' => 'Write name here.', 'id' => 'tasksName' ])->label(false) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label class="formLabel">Description</label>
            <?= $form->field($model, 'description')->textarea(['rows' => '3', 'class' => 'inputForm form-control', 'placeholder' => 'Write description here.', 'id' => 'description' ])->label(false) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
        <hr/>
            <?= Html::submitButton($model->isNewRecord ? '<li class=\'fa fa-save\'></li> Save Record' : '<li class=\'fa fa-save\'></li> Edit Record', ['class' => $model->isNewRecord ? 'formBtn btn btn-primary pull-right btn-sm' : 'form-btn btn btn-primary pull-right btn-sm']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

</div>
<br/>
