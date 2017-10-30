<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectJob;

/**
 * ProjectJobSearch represents the model behind the search form about `common\models\ProjectJob`.
 */
class ProjectJobSearch extends ProjectJob
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'targe_completion_date', 'status'], 'integer'],
            [['project_ref', 'start_date', 'end_date', 'first_inspector', 'second_inspector', 'third_inspector'], 'safe'],
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
            'targe_completion_date' => $this->targe_completion_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'project_ref', $this->project_ref])
            ->andFilterWhere(['like', 'first_inspector', $this->first_inspector])
            ->andFilterWhere(['like', 'second_inspector', $this->second_inspector])
            ->andFilterWhere(['like', 'third_inspector', $this->third_inspector]);

        return $dataProvider;
    }
}
