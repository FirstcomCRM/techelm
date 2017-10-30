<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "projectjob_assignment".
 *
 * @property integer $id
 * @property integer $projectjob_id
 * @property integer $engineer_id
 * @property string $date_created
 */
class ProjectjobAssignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
      //      [['projectjob_id', 'engineer_id'], 'required'],
            [['projectjob_id', 'engineer_id'], 'integer'],
            [['date_created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'projectjob_id' => 'Projectjob ID',
            'engineer_id' => 'Engineer ID',
            'date_created' => 'Date Created',
        ];
    }

    public static function dataProvider($projectjob_id){
        $query = self::find()->where(['projectjob_id'=> $projectjob_id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}
