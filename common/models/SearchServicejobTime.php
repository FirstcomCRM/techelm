<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServicejobTime;

/**
 * SearchServicejobTime represents the model behind the search form about `common\models\ServicejobTime`.
 */
class SearchServicejobTime extends ServicejobTime
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'servicejob_id'], 'integer'],
            [['start_task_time', 'count_time', 'end_task_time'], 'safe'],
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
        $query = ServicejobTime::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'servicejob_id' => $this->servicejob_id,
            'start_task_time' => $this->start_task_time,
            'count_time' => $this->count_time,
            'end_task_time' => $this->end_task_time,
        ]);

        return $dataProvider;
    }
}
