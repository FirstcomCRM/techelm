<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectjobIpiCorrectiveActions;

/**
 * SearchProjectjobIpiCorrectiveActions represents the model behind the search form about `common\models\ProjectjobIpiCorrectiveActions`.
 */
class SearchProjectjobIpiCorrectiveActions extends ProjectjobIpiCorrectiveActions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'projectjob_id', 'status_flag'], 'integer'],
            [['serial_no', 'car_no', 'description', 'target_remedy_date', 'completion_date', 'remarks', 'disposition', 'date_updated', 'form_type'], 'safe'],
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
        $query = ProjectjobIpiCorrectiveActions::find();

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
            'projectjob_id' => $this->projectjob_id,
            'target_remedy_date' => $this->target_remedy_date,
            'completion_date' => $this->completion_date,
            'status_flag' => $this->status_flag,
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'serial_no', $this->serial_no])
            ->andFilterWhere(['like', 'car_no', $this->car_no])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'disposition', $this->disposition])
            ->andFilterWhere(['like', 'form_type', $this->form_type]);

        return $dataProvider;
    }
}
