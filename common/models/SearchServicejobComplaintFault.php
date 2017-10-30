<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServicejobComplaintFault;

/**
 * SearchServicejobComplaintFault represents the model behind the search form about `common\models\ServicejobComplaintFault`.
 */
class SearchServicejobComplaintFault extends ServicejobComplaintFault
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'servicejob_category_id', 'active'], 'integer'],
            [['complaint', 'date_created'], 'safe'],
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
        $query = ServicejobComplaintFault::find();

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
            'servicejob_category_id' => $this->servicejob_category_id,
            'date_created' => $this->date_created,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'complaint', $this->complaint]);

        return $dataProvider;
    }
}
