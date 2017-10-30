<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\ProjectJob;


$task_action =  ArrayHelper::map($action, 'id', 'task_action');
asort($task_action);

?>


<div class="servicejob-form">


    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'], 'id'=>'dynamic-form']); ?>
    <?php echo $form->field($dummy, "description")->hiddenInput()->label(false) ?>

    <div class="panel panel-primary">
        <div class="panel-heading"><span>Complaints</span></div>
        <div class="panel-body">
          <?php DynamicFormWidget::begin([
              'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
              'widgetBody' => '.container-items', // required: css class selector
              'widgetItem' => '.item', // required: css class
              'limit' => 50, // the maximum times, an element can be cloned (default 999)
              'min' => 1, // 0 or 1 (default 1)
              'insertButton' => '.add-item', // css class
              'deleteButton' => '.remove-item', // css class
              'model' => $model[0],
              'formId' => 'dynamic-form',
              'formFields' => [
                  'description',
                  'serial_no',
                  'corrective_actions',
                  'target_completion_date'
              ],
          ]); ?>


            <table class="table table-responsive table-bordered container-items">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Serial No</th>
                        <th>Corretive Actions</th>
                        <th>Target Completion Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach ($model as $i => $line): ?>
                    <tr class="item">
                        <?php
                          if (!$line->isNewRecord) {
                              echo Html::activeHiddenInput($line, "[{$i}]id");
                          }
                        ?>
                        <td>
                          <?php echo $form->field($line,"[{$i}]description")->label(false)->widget(Select2::className(),[
                            'data'=>$task_action,
                            'options'=>['placeholder'=>'Select', 'class'=>'service_category form-control', 'id'=>'cat-'.$i.'-id'],
                            'theme'=> Select2::THEME_BOOTSTRAP,
                            'size'=> Select2::MEDIUM,
                            'pluginOptions' => [
                              'allowClear' => true,
                           ],
                          ]) ?>

                        </td>
                        <td>
                          <?php echo $form->field($line, "[{$i}]serial_no")->textInput()->label(false) ?>

                        </td>
                        <td>
                          <?= $form->field($line, "[{$i}]corrective_actions")->textArea()->label(false) ?>
                        </td>
                        <td>
                          <?= $form->field($line, "[{$i}]target_completion_date")->textInput(['required'=>'','readonly'=> true, 'class'=> 'form-control datepicker target-completion'])->label(false) ?>
                        </td>
                        <td>
                          <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                          <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
              <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
      <?php echo Html::submitButton('<i class="fa fa-pencil" aria-hidden="true"></i> Create', ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



<?php
    $this->registerJsFile(
        '@web/js/inspectionTasks/custom.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );


 ?>
