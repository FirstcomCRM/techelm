<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServicejobActionServiceRepair;

/**
 * ServicejobActionServiceRepairSearch represents the model behind the search form about `common\models\ServicejobActionServiceRepair`.
 */
class ServicejobActionServiceRepairSearch extends ServicejobActionServiceRepair
{
    /**
     * @inheritdoc
     */
     public $arrange;
    public function rules()
    {
        return [
            [['id', 'servicejob_category_id', 'active'], 'integer'],
            [['action', 'date_created', 'arrange'], 'safe'],
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
        $query = ServicejobActionServiceRepair::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
              'defaultOrder'=>['action'=>SORT_ASC],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        print_r($this->arrange);

        if ($this->arrange == 'SORT_DESC') {
          $query->orderBy(['action'=>SORT_DESC]);
        }else{
          $query->orderBy(['action'=>SORT_ASC]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'servicejob_category_id' => $this->servicejob_category_id,
            'date_created' => $this->date_created,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'action', $this->action]);
          //    ->orderBy(['action'=>$this->arrange]);
        //      ->orderBy(['action'=>SORT_DESC]);
        return $dataProvider;
    }
}
