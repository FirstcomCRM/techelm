<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectjobIpi;

/**
 * SearchProjectjobIpi represents the model behind the search form about `common\models\ProjectjobIpi`.
 */
class SearchProjectjobIpi extends ProjectjobIpi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'projectjob_id'], 'integer'],
            [['sub_contractor', 'disposition_by', 'sub_c_signature', 'dispo_by_siganture', 'sub_c_date', 'dispo_by_date', 'date_inspected', 'form_type'], 'safe'],
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
        $query = ProjectjobIpi::find();

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
            'sub_c_date' => $this->sub_c_date,
            'dispo_by_date' => $this->dispo_by_date,
            'date_inspected' => $this->date_inspected,
        ]);

        $query->andFilterWhere(['like', 'sub_contractor', $this->sub_contractor])
            ->andFilterWhere(['like', 'disposition_by', $this->disposition_by])
            ->andFilterWhere(['like', 'sub_c_signature', $this->sub_c_signature])
            ->andFilterWhere(['like', 'dispo_by_siganture', $this->dispo_by_siganture])
            ->andFilterWhere(['like', 'form_type', $this->form_type]);

        return $dataProvider;
    }
}
