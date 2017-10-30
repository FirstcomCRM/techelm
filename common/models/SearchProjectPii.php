<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectPii;

/**
 * SearchProjectPii represents the model behind the search form about `common\models\ProjectPii`.
 */
class SearchProjectPii extends ProjectPii
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'attended_by', 'project_condition', 'status', 'created_by', 'updated_by'], 'integer'],
            [['project_reference', 'cp_code', 'date_sitewalk', 'remarks', 'created_at', 'updated_at'], 'safe'],
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
        $query = ProjectPii::find();

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
            'date_sitewalk' => $this->date_sitewalk,
            'attended_by' => $this->attended_by,
            'project_condition' => $this->project_condition,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'project_reference', $this->project_reference])
            ->andFilterWhere(['like', 'cp_code', $this->cp_code])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
