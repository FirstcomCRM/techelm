<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectjobPiss;

/**
 * SearchProjectjobPiss represents the model behind the search form about `common\models\ProjectjobPiss`.
 */
class SearchProjectjobPiss extends ProjectjobPiss
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'projectjob_id'], 'integer'],
            [['car_park_code', 'property_officer', 'tc_lew', 'property_officer_telNo', 'property_officer_mobileNo', 'property_officer_branch', 'tc_lew_telNo', 'tc_lew_mobileNo', 'tc_lew_email', 'remarks', 'date_site_walk'], 'safe'],
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
        $query = ProjectjobPiss::find();

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
            'date_site_walk' => $this->date_site_walk,
        ]);

        $query->andFilterWhere(['like', 'car_park_code', $this->car_park_code])
            ->andFilterWhere(['like', 'property_officer', $this->property_officer])
            ->andFilterWhere(['like', 'tc_lew', $this->tc_lew])
            ->andFilterWhere(['like', 'property_officer_telNo', $this->property_officer_telNo])
            ->andFilterWhere(['like', 'property_officer_mobileNo', $this->property_officer_mobileNo])
            ->andFilterWhere(['like', 'property_officer_branch', $this->property_officer_branch])
            ->andFilterWhere(['like', 'tc_lew_telNo', $this->tc_lew_telNo])
            ->andFilterWhere(['like', 'tc_lew_mobileNo', $this->tc_lew_mobileNo])
            ->andFilterWhere(['like', 'tc_lew_email', $this->tc_lew_email])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
