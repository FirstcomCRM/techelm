<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workers".
 *
 * @property integer $worker_id
 * @property string $worker_fullname
 * @property integer $worker_status
 */
class Workers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['worker_fullname'], 'required'],
            [['worker_status'], 'integer'],
            [['worker_fullname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'worker_id' => 'Worker ID',
            'worker_fullname' => 'Worker Fullname',
            'worker_status' => 'Worker Status',
        ];
    }
}
