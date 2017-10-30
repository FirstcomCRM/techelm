<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectjobPissTasks;

/**
 * SearchProjectjobPissTasks represents the model behind the search form about `common\models\ProjectjobPissTasks`.
 */
class SearchProjectjobPissTasks extends ProjectjobPissTasks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'projectjob_id'], 'integer'],
            [['serial_no', 'description', 'conformance', 'comments', 'status', 'drawing_before', 'drawing_after', 'date_updated'], 'safe'],
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
        $query = ProjectjobPissTasks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination'=>[
              'pageSize'=>5,
            ],
        ]);
        $dataProvider->query->where(['active' => 1]);

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
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'serial_no', $this->serial_no])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'conformance', $this->conformance])
            ->andFilterWhere(['like', 'comments', $this->comments])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'drawing_before', $this->drawing_before])
            ->andFilterWhere(['like', 'drawing_after', $this->drawing_after]);

        return $dataProvider;
    }
}
