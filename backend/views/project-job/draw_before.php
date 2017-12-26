<?php

use yii\helpers\Html;
use common\components\Helper;
use common\models\ProjectjobPissTasksDrawing;

$counter = 0;
?>

<ul>
<?php $data =  ProjectjobPissTasksDrawing::find()->where(['projectjob_piss_tasks_id'=>$model->id])->asArray()->all(); ?>
<?php if (!empty($data)): ?>
  <?php foreach ($data as $key => $value): ?>
    <?php $counter++ ?>
    <?php if ($value['drawing_before'] == 'NO FILE UPLOADED' || empty($value['drawing_before'] ) || is_null($value['drawing_before']) ): ?>
      <?php continue; ?>
    <?php else: ?>
      <?php   $path = Yii::getAlias('@api-signature').$value['drawing_before']; ?>
      <li><a href="<?php echo $path ?>" data-pjax=0>Image-<?php echo $counter ?></a></li>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php $counter = 0; ?>
<?php endif; ?>
</ul>
