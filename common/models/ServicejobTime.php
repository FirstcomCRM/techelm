<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_time".
 *
 * @property integer $id
 * @property integer $servicejob_id
 * @property string $start_task_time
 * @property string $count_time
 * @property string $end_task_time
 */
class ServicejobTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicejob_id', 'count_time'], 'required'],
            [['servicejob_id'], 'integer'],
            [['start_task_time', 'count_time', 'end_task_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'servicejob_id' => 'Servicejob ID',
            'start_task_time' => 'Start Task Time',
            'count_time' => 'Count Time',
            'end_task_time' => 'End Task Time',
        ];
    }
}
