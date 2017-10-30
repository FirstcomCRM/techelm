<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServicejobPrices;

/**
 * SearchServicejobPrices represents the model behind the search form about `common\models\ServicejobPrices`.
 */
class SearchServicejobPrices extends ServicejobPrices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'servicejob_id', 'quantity'], 'integer'],
            [['replacement_parts'], 'safe'],
            [['unit_price'], 'number'],
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
        $query = ServicejobPrices::find();

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
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
        ]);

        $query->andFilterWhere(['like', 'replacement_parts', $this->replacement_parts]);

        return $dataProvider;
    }
}
