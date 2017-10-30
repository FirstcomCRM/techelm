<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServicejobUploads;

/**
 * SearchServicejobUploads represents the model behind the search form about `common\models\ServicejobUploads`.
 */
class SearchServicejobUploads extends ServicejobUploads
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'servicejob_id'], 'integer'],
            [['taken', 'upload_name', 'file_path', 'size', 'date_added'], 'safe'],
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
        $query = ServicejobUploads::find();

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
            'date_added' => $this->date_added,
        ]);

        $query->andFilterWhere(['like', 'taken', $this->taken])
            ->andFilterWhere(['like', 'upload_name', $this->upload_name])
            ->andFilterWhere(['like', 'file_path', $this->file_path])
            ->andFilterWhere(['like', 'size', $this->size]);

        return $dataProvider;
    }
}
