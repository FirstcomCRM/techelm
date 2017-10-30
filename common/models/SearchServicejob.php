<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Servicejob;

/**
 * SearchServicejob represents the model behind the search form about `common\models\Servicejob`.
 */
class SearchServicejob extends Servicejob
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'service_id', 'engineer_id', 'status'], 'integer'],
            [['service_no', 'complaint', 'remarks', 'remarks_before', 'remarks_after', 'equipment_type', 'serial_no', 'start_date', 'end_date', 'type_of_service', 'signature_name', 'start_date_task',
            'end_date_task','service_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
          $query = Servicejob::find();
        $start = '';
        $end = '';
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        //    'pagination'=>[
        //      'pageSize'=>1,
        //    ],
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);
        $dataProvider->query->where(['active' => 1]);

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
        ]);

        $query->andFilterWhere(['like', 'service_no', $this->service_no])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'remarks_before', $this->remarks_before])
            ->andFilterWhere(['like', 'remarks_after', $this->remarks_after])
            ->andFilterWhere(['like', 'equipment_type', $this->equipment_type])
            ->andFilterWhere(['like', 'serial_no', $this->serial_no])
            ->andFilterWhere(['like', 'signature_name', $this->signature_name])
            ->andFilterWhere(['between', 'service_Date', $start,$end]);

        return $dataProvider;
    }

    public function customSearch($params){

        //$query = (new Query())->select(['servicejob.*','servicejob_mobile_complaint.*'])
          //    ->from('servicejob')
          //    ->join('LEFT JOIN','servicejob_mobile_complaint','servicejob.id=servicejob_mobile_complaint.id');
          $start = '';
          $end = '';
          $complaint_cat = null;
          $complaints = null;
          $query = Servicejob::find()
              ->select(['servicejob.*','servicejob_complaint_mobile.servicejob_category_id','servicejob_complaint_mobile.complaint_id'])
              ->join('LEFT JOIN','servicejob_complaint_mobile','servicejob.id=servicejob_complaint_mobile.servicejob_id')
          //    ->join('LEFT JOIN','servicejob_categories','servicejob_categories.id=servicejob_complaint_mobile.servicejob_category_id')
              ->where(['servicejob.active'=>1])
              ->groupBy('servicejob.id');

        //var_dump($query);die();
        $dataProvider = new ActiveDataProvider([
              'query' => $query,
          //    'pagination'=>[
        //      'pageSize'=>1,
          //    ],
              'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);


          //var_dump($complaint);die();
          if (isset($_GET['complaint-cat'])) {
            $complaint_cat= $_GET['complaint-cat'];
          }
          if (isset($_GET['complaints'])) {
            $complaints = $_GET['complaints'];
          }


          $this->load($params);
          if (!empty($this->service_date)) {
            list($start,$end)= explode(' - ',$this->service_date);
          }
        //  var_dump($params);die();
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

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
            'servicejob_complaint_mobile.servicejob_category_id'=>$complaint_cat,
            'servicejob_complaint_mobile.complaint_id'=>$complaints,
        ]);

        $query->andFilterWhere(['like', 'service_no', $this->service_no])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'remarks_before', $this->remarks_before])
            ->andFilterWhere(['like', 'remarks_after', $this->remarks_after])
            ->andFilterWhere(['like', 'equipment_type', $this->equipment_type])
            ->andFilterWhere(['like', 'serial_no', $this->serial_no])
            ->andFilterWhere(['like', 'signature_name', $this->signature_name])
            ->andFilterWhere(['between', 'service_Date', $start,$end]);
            //->andFilterWhere(['like', 'servicejob_complaint_mobile.servicejob_category_id', $complaint_cat])
        //    ->andFilterWhere(['like', 'servicejob_complaint_mobile.complaint_id', $complaints]);
        return $dataProvider;

    }

    public function dashBoard(){
        $query = Servicejob::find();

        $dates = new \DateTime();
        $dates->modify("-2 day");
        $start = $dates->format('Y-m-d');
        $end = date('Y-m-d');

      //  print_r(gettype(date('Y-m-d')));die();

      $dataProvider = new ActiveDataProvider([
          'query' => $query,
           'pagination'=>[
             'pageSize'=>10,
            ],
          'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
      ]);
      $dataProvider->query->where(['active' => 1])
            ->andWhere(['!=', 'status', 3])
            ->andWhere(['between','service_date',$start,$end]);

    //  $this->load($params);



        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        return $dataProvider;
    }
}
