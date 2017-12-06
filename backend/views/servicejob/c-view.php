<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\Helper;
use common\models\Customer;
use common\models\Service;
use common\models\User;
use common\models\ServicejobCategories;
use common\models\ServicejobComplaintFault;
use common\models\Equipments;
/* @var $this yii\web\View */
/* @var $model common\models\Servicejob */

$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Servicejobs', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

//$data = str_replace('image/svg+xml,', '', $model->signature_web);
//$//test = 'data:image/svg+xml,'.'';
//echo $test;


/*$jsig =<<<EOF

var i = new Image();
i.src = "data:" +  "image/svg+xml," + '$data';
i.class ="img-responsive";
console.log(i);
//$(i).appendTo("#signature");
EOF;

$this->registerJS($jsig);
$dat = Yii::$app->request->referrer*/
//$path = Yii::getAlias('@path1').$model->signature_name;
//echo $path;
?>
<div class="servicejob-view">

    <p class="text-right">

        <?php echo Html::a('Back',['/customer/c-view', 'id'=>$model->customer_id],['class'=>'btn btn-primary']) ?>
        <?php //echo Html::a('Sign',['/servicejob/sign', 'id'=>$model->id],['class'=>'btn  btn-primary']) ?>
        <?php if ($model->status == 1 || $model->status == 2)  : ?>
          <?= Html::a('<i class="fa fa-pencil" aria-hidden="true"></i> Sign', ['c-form', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
        <?= Html::a('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> View Service Report', ['pdf-service', 'id' => $model->id], ['class' => 'btn btn-primary','target'=>'_blank']) ?>
        <?= Html::a('<i class="fa fa-file-pdf-o" aria-hidden="true"></i> View Parts PDF', ['pdf-parts', 'id' => $model->id], ['class' => 'btn btn-primary','target'=>'_blank']) ?>
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
                return Helper::retrieveCustomer($model->customer_id);
              },
            ],
            [
              'attribute'=>  'service_id',
              'label'=>'Service',
              'value'=> function ($model){
                  return Helper::retriveService($model->service_id);
                },
            ],
          //  'engineer_id',
            [
              'attribute'=> 'engineer_id',
              'label'=>'Engineer',
              'value'=> function ($model){
                return Helper::retriveUserFull($model->engineer_id);
                },
            ],
            'remarks:ntext',
          //  'remarks_before:ntext',
          //  'remarks_after:ntext',
            'equipment_type',
            [
            //  'attribute'=>'equipment_type',
              'label'=>'Equipment Description',
              'value'=> function($model){
                $data  = Equipments::find()->where(['equipment_code'=>$model->equipment_type])->one();
                if (!empty($data)) {
                  return $data->description;
                }else{
                  return $data = null;
                }
              }
            ],
            'serial_no',
            'service_date',
            [
                'attribute'=>'status',
                'label' => 'Status',
                'format' => 'raw',
                'value' => function($model){
                    return Helper::createStatusFlag($model->status);
                }
            ],
            'remarks_before:ntext',
            'remarks_after:ntext',
            'start_date_task',
            'end_date_task',
          /*  [
              'attribute'=>'signature_web',
              'label'=>'Client Signature - Web',
              'format'=>'raw',
              'value'=>function ($model){
                $data =  "<img class='img-responsve' src=$model->signature_web>";
                return $data;
              },
            ],*/
            //'signature_web',
        //    'end_date',
        //    'status',
    //        'signature_name',
      //      'start_date_task',
      //      'end_date_task',
        ],
    ]) ?>

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
              if (!empty($cat)) {
                return $cat->category;
              }else{
                return $cat = null;
              }

            },
          ],

          [
            'attribute'=>  'complaint_id',
            'label'=>'Complaint',
            'value'=>function($line){
              $com =ServicejobComplaintFault::find()->where(['id'=>$line->complaint_id])->one();
              if (!empty($com)) {
                return $com->complaint;
              }

            },
          ],
          'complaint_remark',
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

<?php if (!empty($modelParts)): ?>
  <h4>Parts List</h4>
  <?php foreach ($modelParts as $line): ?>
    <?= DetailView::widget([
    'model' => $line,
    'attributes' => [
    //    'id',
      //  'servicejob_id',
      /*  [
        'attribute'=>'servicejob_id',
        'label'=> 'Service Job',
        'value'=>function ($model){

            return Helper::retriveService($model->servicejob_id);

        },
      ],*/
      'parts_name:ntext',
      'quantity:ntext',

      [
        'attribute'=>'unit_price',
        'label'=> 'Unit Price',
        'value'=> function($model){
          return number_format($model->unit_price,2);
        },
      ],
       [
         'attribute'=>'total_price',
         'label'=> 'Total Price',
         'value'=> function($model){
           return number_format($model->total_price,2);
         },
       ],

      [
        'attribute'=>'date_added',
        'label'=> 'Date',
      ],
    ],
  ]) ?>
  <?php endforeach; ?>
<?php endif; ?>


</div>
