<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projectjob".
 *
 * @property integer $id
 * @property string $project_ref
 * @property integer $customer_id
 * @property string $start_date
 * @property string $end_date
 * @property string $target_completion_date
 * @property integer $first_inspector
 * @property integer $second_inspector
 * @property integer $third_inspector
 * @property integer $status_flag
 */
class Projectjob extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'start_date', 'status_flag'], 'required'],
            [['customer_id', 'first_inspector', 'second_inspector', 'third_inspector', 'status_flag'], 'integer'],
            [['start_date','date_created','date_updated', 'end_date'], 'safe'],
            [['created_by'],'string'],
            [['project_ref'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_ref' => 'Project Ref',
            'customer_id' => 'Customer',
            'start_date' => 'Date of Site Walk',
            'end_date' => 'End Date',
            'target_completion_date' => 'Target Completion Date',
            'first_inspector' => 'First Inspector',
            'second_inspector' => 'Second Inspector',
            'third_inspector' => 'Third Inspector',
            'status_flag' => 'Status Flag',
        ];
    }

    public static function getEvents(){
        $query = "SELECT project_ref as title, start_date as start, status_flag FROM ". Projectjob::tableName();
        return  Yii::$app->db->createCommand($query)->queryAll();
    }
}
