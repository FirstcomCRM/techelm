<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
//use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Servicejob;
use common\models\Company;
use common\models\User;
use common\models\UserPermission;
use common\models\ServicejobParts;
use yii\filters\AccessControl;
use yii\db\Query;
//use yii\helpers\ArrayHelper;
//class Reports extends \yii\base\Model
class Reports extends Servicejob
{
  public $year;
  public $parts;
  public $start;
  public $end;
  public $complaint_cat;
  public $complaint;
  public $action;
  public $active;
  public function rules()
  {
      return [
          [['id', 'customer_id', 'service_id', 'engineer_id', 'status'], 'integer'],
          [['service_no', 'complaint', 'remarks', 'remarks_before', 'remarks_after', 'equipment_type', 'serial_no', 'start_date', 'end_date', 'type_of_service', 'signature_name', 'start_date_task',
          'end_date_task','service_date','year','active','parts','complaint_cat','complaint','action','start','end'], 'safe'],
      ];
  }

  /*public function scenarios()
  {
      // bypass scenarios() implementation in the parent class
      return Model::scenarios();
  }*/


  public function report_a($params){
  //  $query = Servicejob::find();
    $query = Servicejob::find()->select(['service_no','customer_id','service_id','engineer_id','service_date','remarks','equipment_type','serial_no','status']);
    $start = '';
    $end = '';
  // add conditions that should always apply here

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination'=>false,
        'pagination'=>[
          'pageSize'=>10,
        ],
        'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
    ]);

    //$dataProvider->query->all();

    $this->load($params);

      if (!empty($this->service_date)) {
        list($start,$end)= explode(' - ',$this->service_date);
      }

    if (!$this->validate()) {
        // uncomment the following line if you do not want to return any records when validation fails
        // $query->where('0=1');
        return $dataProvider;
    }

      // grid filtering conditions
    if (!empty($this->service_no) || !empty($this->customer_id) || !empty($this->service_id) || !empty($this->engineer_id) || !empty($this->status) || !empty($this->active)  || !empty($this->service_date) || !empty($this->remarks) || !empty($this->year) ) {
      $query->andFilterWhere([
          'id' => $this->id,
          'customer_id' => $this->customer_id,
          'service_id' => $this->service_id,
          'engineer_id' => $this->engineer_id,
          'start_date' => $this->start_date,
          'end_date' => $this->end_date,
          'status' => $this->status,
          'start_date_task' => $this->start_date_task,
          'end_date_task' => $this->end_date_task,
          'active'=>$this->active,
          'service_no'=>$this->service_no
      ]);

    //  $query->andFilterWhere(['like', 'service_no', $this->service_no])
        $query->andFilterWhere(['like', 'remarks', $this->remarks])
          ->andFilterWhere(['like', 'remarks_before', $this->remarks_before])
          ->andFilterWhere(['like', 'remarks_after', $this->remarks_after])
          ->andFilterWhere(['like', 'equipment_type', $this->equipment_type])
          ->andFilterWhere(['like', 'serial_no', $this->serial_no])
          ->andFilterWhere(['like', 'signature_name', $this->signature_name])
          ->andFilterWhere(['between', 'service_Date', $start,$end])
          ->andFilterWhere(['like', 'service_Date', $this->year]);
    }else{
      $query->andFilterWhere(['id'=>0]);
    }

    return $dataProvider;
  }

  public function report_d($params){

      $query =ServicejobParts::find()
          ->select(['servicejob.service_no','servicejob.customer_id','servicejob.engineer_id','servicejob.service_date','servicejob_parts.parts_name','servicejob_parts.quantity',
            'servicejob_parts.unit_price','servicejob_parts.total_price','servicejob_parts.servicejob_id'])
          ->JOIN('LEFT JOIN', 'servicejob','servicejob.id=servicejob_parts.servicejob_id');
          //->with('servicejob');
        //  ->orderBy(['servicejob_parts.id'=>SORT_DESC]);
      //    ->groupBy('servicejob_parts.servicejob_id');

      $dataProvider = new ActiveDataProvider([
          'query' => $query,
         'pagination'=>false,
          'sort'=> ['defaultOrder' => ['servicejob_id'=>SORT_DESC]]
      ]);

    /*  $dataProvider->sort->attributes['service_no'] = [
        'asc' => ['servicejob.service_no' => SORT_ASC],
        'desc' => ['servicejob.service_no' => SORT_DESC],
    ];*/

    $dataProvider->setSort([
      'attributes'=>[
        'parts_name',
        'service_no',
        'service_date',
        'quantity',
        'unit_price',
        'total_price',
      ],
    ]);

      //$dataProvider->query->all();

      $this->load($params);

      if (!empty($this->service_date)) {
        list($this->start,$this->end)= explode(' - ',$this->service_date);
      }

      if (!empty($this->service_no) || !empty($this->parts) || !empty($this->customer_id) || !empty($this->engineer_id) || !empty($this->service_date) ) {
        $query->andFilterWhere([
            'customer_id' => $this->customer_id,
            'engineer_id' => $this->engineer_id,
              //    'service_id' => $this->service_id,
        ]);

        $query->andFilterWhere(['like','servicejob.service_no',$this->service_no])
              ->andFilterWhere(['like','servicejob_parts.parts_name',$this->parts])
              ->andFilterWhere(['between', 'servicejob.service_Date', $this->start,$this->end]);
      }else {
        $query->andFilterWhere(['servicejob_parts.id'=>0]);
      }

      return $dataProvider;
  }

  public function report_b($params){
    $rows = new Query();
    $this->load($params);

    if (!empty($this->service_date)) {
      list($this->start,$this->end)= explode(' - ',$this->service_date);
    }

    $result = $rows->select(['servicejob.id as ids', 'servicejob.service_no','servicejob.customer_id','servicejob.engineer_id','servicejob.service_date','servicejob.status','servicejob.active','servicejob.remarks',
        'servicejob_complaint_mobile.servicejob_id','servicejob_complaint_mobile.id',  'servicejob_complaint_mobile.servicejob_category_id',  'servicejob_complaint_mobile.complaint_name',  'servicejob_complaint_mobile.complaint_remark',
        'servicejob_cm_asr.servicejob_cm_cf_id','servicejob_cm_asr.servicejob_action_service_repair_id','servicejob_cm_cf.id'
    ])
    ->from('servicejob')
    ->join('LEFT JOIN', 'servicejob_complaint_mobile', 'servicejob.id = servicejob_complaint_mobile.servicejob_id')
    ->join('LEFT JOIN', 'servicejob_cm_cf', 'servicejob_complaint_mobile.id = servicejob_cm_cf.servicejob_complaint_mobile_id')
    ->join('LEFT JOIN', 'servicejob_cm_asr', 'servicejob_cm_asr.servicejob_cm_cf_id=servicejob_cm_cf.id')
    ->orderBy(['ids'=>SORT_ASC])
    //->join('LEFT JOIN', 'servicejob_complaint_mobile', 'servicejob.id = servicejob_complaint_mobile.servicejob_id')
//    ->join('LEFT JOIN', 'servicejob_cm_asr', 'servicejob_cm_asr.servicejob_cm_cf_id=servicejob_complaint_mobile.id')
    ->andFilterWhere(['customer_id'=>$this->customer_id,
          'engineer_id' => $this->engineer_id,
          'status'=>$this->status,
          'servicejob.active'=>$this->active,
          'servicejob_category_id'=>$this->complaint_cat,
          'servicejob_action_service_repair_id'=>$this->action,
        ])
    ->andFilterWhere(['like', 'service_no', $this->service_no])
    ->andFilterWhere(['between', 'service_Date', $this->start,$this->end])
    ->andFilterWhere(['like', 'service_Date', $this->year])
    ->andFilterWhere(['like','complaint_name',$this->complaint])
    ->andFilterWhere(['like','remarks',$this->remarks])
    ->all();

  //  $rows->andFilterWhere(['like', 'service_no', $this->service_no]);
    return $result;
  }

  public function report_ba($params){
  //  $query =Servicejob::find()->limit(10);
    $query = new Query();

        $query->select(['servicejob.id as ids', 'servicejob.service_no','servicejob.customer_id','servicejob.engineer_id','servicejob.service_date','servicejob.status','servicejob.active','servicejob.remarks',
            'servicejob_complaint_mobile.servicejob_id','servicejob_complaint_mobile.id',  'servicejob_complaint_mobile.servicejob_category_id',  'servicejob_complaint_mobile.complaint_name',  'servicejob_complaint_mobile.complaint_remark',
            'servicejob_cm_asr.servicejob_cm_cf_id','servicejob_cm_asr.servicejob_action_service_repair_id','servicejob_cm_cf.id','customer.fullname','user.fullname as eng_name', 'servicejob_categories.category as com_cat', 'servicejob_action_service_repair.action'
        ])
        ->from('servicejob')
        ->join('LEFT JOIN', 'servicejob_complaint_mobile', 'servicejob.id = servicejob_complaint_mobile.servicejob_id')
        ->join('LEFT JOIN', 'servicejob_cm_cf', 'servicejob_complaint_mobile.id = servicejob_cm_cf.servicejob_complaint_mobile_id')
        ->join('LEFT JOIN', 'servicejob_cm_asr', 'servicejob_cm_asr.servicejob_cm_cf_id=servicejob_cm_cf.id')
        ->join('LEFT JOIN', 'customer', 'customer.id=servicejob.customer_id')
        ->join('LEFT JOIN', 'user', 'user.id=servicejob.engineer_id')
        ->join('LEFT JOIN', 'servicejob_categories', 'servicejob_categories.id=servicejob_complaint_mobile.servicejob_category_id')
        ->join('LEFT JOIN', 'servicejob_action_service_repair', 'servicejob_action_service_repair.id=servicejob_cm_asr.servicejob_action_service_repair_id');
        //->limit(10);
    //  $query->groupBy(['servicejob.service_no']);

      $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination'=>false,
          //  'sort'=> ['defaultOrder' => ['ids'=>SORT_DESC]]
      ]);

      $dataProvider->setSort([
        'attributes'=>[
          'service_no',
          'eng_name',
          'fullname',
          'engineer_id',
          'service_date',
          'status',
          'com_cat',
          'complaint_name',
          'action',
        ],
      ]);

      $this->load($params);

      if (!empty($this->service_date)) {
        list($this->start,$this->end)= explode(' - ',$this->service_date);
      }

      if (!empty($this->service_no) || !empty($this->customer_id) || !empty($this->engineer_id) || !empty($this->status) || !empty($this->service_date) || !empty($this->year) || !empty($this->complaint_cat) || !empty($this->complaint) || !empty($this->action) ||
        !empty($this->remarks)
     ) {

              $query->andFilterWhere(['customer_id'=>$this->customer_id,
                    'engineer_id' => $this->engineer_id,
                    'servicejob.status'=>$this->status,
                  //  'servicejob.active'=>$this->active,
                    'servicejob_complaint_mobile.servicejob_category_id'=>$this->complaint_cat,
                    'servicejob_action_service_repair_id'=>$this->action,
                    'servicejob.active'=>1,
                  ])
              ->andFilterWhere(['like', 'service_no', $this->service_no])
              ->andFilterWhere(['between', 'service_Date', $this->start,$this->end])
              ->andFilterWhere(['like', 'service_Date', $this->year])
              ->andFilterWhere(['like','complaint_name',$this->complaint])
              ->andFilterWhere(['like','remarks',$this->remarks]);
      }else{
          $query->andFilterWhere(['servicejob.id'=>0]);
      }


      return $dataProvider;
  }


}
