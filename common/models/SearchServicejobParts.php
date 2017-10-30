<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServicejobParts;

/**
 * SearchServicejobParts represents the model behind the search form about `common\models\ServicejobParts`.
 */
class SearchServicejobParts extends ServicejobParts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'servicejob_id'], 'integer'],
            [['parts_name', 'quantity', 'unit_price', 'total_price', 'date_added'], 'safe'],
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
        $query = ServicejobParts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'date_added' => $this->date_added,
        ]);

        $query->andFilterWhere(['like', 'parts_name', $this->parts_name])
            ->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'unit_price', $this->unit_price])
            ->andFilterWhere(['like', 'total_price', $this->total_price]);

        return $dataProvider;
    }

    public function jobSearch($id){
      $query = ServicejobParts::find();

      // add conditions that should always apply here

      $dataProvider = new ActiveDataProvider([
          'query' => $query,
          'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
          'pagination'=>[
            'pageSize'=>10,
          ],
      ]);
      $dataProvider->query->where(['servicejob_id' => $id]);
      return $dataProvider;
    }
}
