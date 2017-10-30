<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectjobIpiTasks;

/**
 * SearchProjectjobIpiTasks represents the model behind the search form about `common\models\ProjectjobIpiTasks`.
 */
class SearchProjectjobIpiTasks extends ProjectjobIpiTasks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'projectjob_id', 'serial_no', 'status_flag'], 'integer'],
            [['description', 'status', 'non_conformance', 'corrective_actions', 'target_completion_date', 'date_updated', 'form_type'], 'safe'],
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
        $query = ProjectjobIpiTasks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
              'pageSize'=>5,
            ],
            'sort'=>[
              'defaultOrder'=>[
                'id'=>SORT_DESC,
              ],
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
            'serial_no' => $this->serial_no,
            'target_completion_date' => $this->target_completion_date,
            'status_flag' => $this->status_flag,
            'date_updated' => $this->date_updated,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'non_conformance', $this->non_conformance])
            ->andFilterWhere(['like', 'corrective_actions', $this->corrective_actions])
            ->andFilterWhere(['like', 'form_type', $this->form_type]);

        return $dataProvider;
    }
}
