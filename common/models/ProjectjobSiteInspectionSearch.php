<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProjectjobSiteInspection;

/**
 * ProjectjobSiteInspectionSearch represents the model behind the search form about `common\models\ProjectjobSiteInspection`.
 */
class ProjectjobSiteInspectionSearch extends ProjectjobSiteInspection
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','project_ref', 'subcontractor', 'inspected_by'], 'integer'],
            [[ 'date_inspection', 'work_completion_start_date', 'work_completion_end_date', 'field_type', 'date_created'], 'safe'],
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
        $query = ProjectjobSiteInspection::find();

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
            'project_ref' => $this->project_ref,
            'subcontractor'=>$this->subcontractor,
            'date_inspection' => $this->date_inspection,
            'work_completion_start_date' => $this->work_completion_start_date,
            'work_completion_end_date' => $this->work_completion_end_date,
            'inspected_by' => $this->inspected_by,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'field_type', $this->field_type]);
          


        return $dataProvider;
    }
}
