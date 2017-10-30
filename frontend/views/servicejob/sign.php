<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$data = str_replace('image/svg+xml,', '', $model->signature_web);

$jsig =<<<EOF

var i = new Image();
i.src = "data:" +  "image/svg+xml," + '$data';
//console.log(i);
//$(i).appendTo("#showImage");
EOF;

$this->registerJS($jsig);
?>


<?php $form = ActiveForm::begin(); ?>
<div class="wrapper">
  <div class="">
    <h2 class="override" style="color:black">Client Signature</h2>
  </div>
  <br>
  <div class="showImage" id="showImage">

  </div>
  <div id="signature1">

  </div>

  <?php  echo $form->field($model, 'signature_web')->hiddenInput()-> label(false) ?>


  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-pencil" aria-hidden="true"></i> Create' : '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary' ,'id'=>'test']) ?>
  </div>

</div>

<?php ActiveForm::end(); ?>
