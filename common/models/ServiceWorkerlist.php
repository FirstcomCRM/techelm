<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_workerlist".
 *
 * @property integer $id
 * @property integer $service_id
 * @property string $user_id
 * @property string $service_condition
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class ServiceWorkerlist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_workerlist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'user_id', 'service_condition', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['service_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'string', 'max' => 100],
            [['service_condition'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'user_id' => 'User ID',
            'service_condition' => 'Service Condition',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
