<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectJob;
use common\models\ProjectjobPiss;
use common\models\ProjectjobPissTasks;
use yii\data\SqlDataProvider;
/**
 * SearchProjectJob represents the model behind the search form about `common\models\ProjectJob`.
 */
class SearchProjectJob extends ProjectJob
{

    public function rules()
    {
        return [
            [['id', 'customer_id', 'first_inspector', 'second_inspector', 'third_inspector', 'status_flag'], 'integer'],
            [['project_ref', 'start_date', 'end_date', 'target_completion_date'], 'safe'],
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
        $query = ProjectJob::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->query->where(['active' => 1]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'target_completion_date' => $this->target_completion_date,
            'first_inspector' => $this->first_inspector,
            'second_inspector' => $this->second_inspector,
            'third_inspector' => $this->third_inspector,
            'status_flag' => $this->status_flag,

        ]);

        $query->andFilterWhere(['like', 'project_ref', $this->project_ref]);

        return $dataProvider;
    }

    public static function searchJoinTasks($ProjectJobId){
        $query = 'SELECT * FROM '. ProjectjobPiss::tableName() . ' a LEFT JOIN '. ProjectjobPissTasks::tableName() . ' b ON a.projectjob_id=b.projectjob_id WHERE a.projectjob_id = '. $ProjectJobId;

        $count = Yii::$app->db->createCommand(
           'SELECT COUNT(*) FROM '. ProjectjobPiss::tableName() . ' a LEFT JOIN '. ProjectjobPissTasks::tableName() . ' b ON a.projectjob_id=b.projectjob_id WHERE a.projectjob_id = '. $ProjectJobId)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $query,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'title',
                    'view_count',
                    'created_at',
                ],
            ],
        ]);


        return $dataProvider;
    }

    public function dashBoard(){
      $query = ProjectJob::find();
      $dataProvider = new ActiveDataProvider([
          'query' => $query,
          'pagination'=>[
            'pageSize'=>10, 
           ],
         'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
      ]);
      $dataProvider->query->where(['active' => 1]);

      if (!$this->validate()) {
          // uncomment the following line if you do not want to return any records when validation fails
          // $query->where('0=1');
          return $dataProvider;
      }
      return $dataProvider;
    }
}
