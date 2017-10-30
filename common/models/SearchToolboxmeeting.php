<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Toolboxmeeting;

/**
 * SearchToolboxmeeting represents the model behind the search form about `common\models\Toolboxmeeting`.
 */
class SearchToolboxmeeting extends Toolboxmeeting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'projectjob_id', 'status_flag_tm'], 'integer'],
            [['meeting_image', 'meeting_details', 'conducted_by', 'designation', 'signature'], 'safe'],
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
        $query = Toolboxmeeting::find();

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
            'status_flag_tm' => $this->status_flag_tm,
        ]);

        $query->andFilterWhere(['like', 'meeting_image', $this->meeting_image])
            ->andFilterWhere(['like', 'meeting_details', $this->meeting_details])
            ->andFilterWhere(['like', 'conducted_by', $this->conducted_by])
            ->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'signature', $this->signature]);

        return $dataProvider;
    }
}
