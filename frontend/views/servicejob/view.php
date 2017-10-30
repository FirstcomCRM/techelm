<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use common\models\ServicejobCategories;
use common\models\ServicejobComplaintFault;
/* @var $this yii\web\View */
/* @var $model common\models\Servicejob */

//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Customer', 'url' => ['customer/view','id'=>$model->customer_id ]];
//$this->params['breadcrumbs'][] = $this->title;

$data = str_replace('image/svg+xml,', '', $model->signature_web);

$jsig =<<<EOF

var i = new Image();
i.src = "data:" +  "image/svg+xml," + '$data';
//i.class ="img-responsive";
console.log(i);
$(i).appendTo("#signature");
EOF;

$this->registerJS($jsig);

$dat = Yii::$app->request->referrer
?>


<div class="servicejob-view">
      <?php Html::a('Back', $dat, ['class' => 'btn btn-primary']) ?>


    <p class="text-right">
        <?php echo Html::a('Back',['/customer/view', 'id'=>$model->customer_id],['class'=>'btn btn-primary']) ?>
    </p>
    <h4>Service Job</h4>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'service_no',
            [
              'attribute'=>'customer_id',
              'label'=>'Customer',
              'value'=> function ($model){
                  $customer = Customer::find()->where(['id'=>$model->customer_id])->one();
                  return $customer->fullname;
              },
            ],
            [
              'attribute'=>  'service_id',
              'label'=>'Service',
              'value'=> function ($model){
                  $service = Service::find()->where(['id'=>$model->service_id])->one();
                  return $service->service_name;
                },
            ],
          //  'engineer_id',
            [
              'attribute'=> 'engineer_id',
              'label'=>'Engineer',
              'value'=> function ($model){
                  $engineer = User::find()->where(['id'=>$model->engineer_id])->one();
                  return $engineer->fullname;
                },
            ],
            'remarks:ntext',
          //  'remarks_before:ntext',
          //  'remarks_after:ntext',
            'equipment_type',
            'serial_no',
            'start_date',
          //  'signature_web',
            [
              'attribute'=>'signature_web',
              'label'=>'Client Signature',
              'format'=>'raw',
              'value'=>function ($model, $test){
                $data =  "<img class='img-responsve' src=$model->signature_web>";
                return $data;
                //$data = str_replace('image/svg+xml,', '', $model->signature_web);
                //return $data;
              },
            ]
        //    'end_date',
        //    'status',
    //        'signature_name',
      //      'start_date_task',
      //      'end_date_task',
        ],
    ]) ?>

  <!---  <table class="table table-bordered">
      <tr>
        <td >Client Signature</td>
        <td id="signature"></td>
      </tr>
    </table>--->

    <h4>List of Complaints</h4>
    <?php foreach ($modelComplaints as $line): ?>
      <?= DetailView::widget([
      'model' => $line,
      'attributes' => [

          [
            'attribute'=>  'servicejob_category_id',
            'label'=>'Complaint Category',
            'value'=>function($line){
              $cat =ServicejobCategories::find()->where(['id'=>$line->servicejob_category_id])->one();
              return $cat->category;
            },
          ],

          [
            'attribute'=>  'complaint_id',
            'label'=>'Complaint',
            'value'=>function($line){
              $com =ServicejobComplaintFault::find()->where(['id'=>$line->complaint_id])->one();
              return $com->complaint;
            },
          ],
          'date_created',
      //    'complaint_id',
        //  'active',
        //  'Action:ntext',
        //  'id',
        //  'servicejob_id',
        //  'servicejob_category_id',
      ],
    ]) ?>
    <?php endforeach; ?>


</div>
