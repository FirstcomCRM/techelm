<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_recordings".
 *
 * @property integer $id
 * @property integer $servicejob_id
 * @property string $taken
 * @property string $recording_name
 * @property string $file_path
 * @property string $size
 * @property string $date_added
 */
class ServicejobRecordings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_recordings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicejob_id', 'recording_name', 'file_path', 'size'], 'required'],
            [['servicejob_id'], 'integer'],
            [['date_added'], 'safe'],
            [['taken', 'size'], 'string', 'max' => 255],
            [['recording_name', 'file_path'], 'string', 'max' => 100],
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
            'taken' => 'Taken',
            'recording_name' => 'Recording Name',
            'file_path' => 'File Path',
            'size' => 'Size',
            'date_added' => 'Date Added',
        ];
    }
}
