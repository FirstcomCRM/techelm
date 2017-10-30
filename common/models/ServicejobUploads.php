<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_uploads".
 *
 * @property integer $id
 * @property integer $servicejob_id
 * @property string $taken
 * @property string $upload_name
 * @property string $file_path
 * @property string $size
 * @property string $date_added
 */
class ServicejobUploads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_uploads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicejob_id', 'upload_name', 'file_path', 'size'], 'required'],
            [['servicejob_id'], 'integer'],
            [['date_added'], 'safe'],
            [['taken', 'size'], 'string', 'max' => 255],
            [['upload_name'], 'string', 'max' => 100],
            [['file_path'], 'string', 'max' => 150],
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
            'upload_name' => 'Upload Name',
            'file_path' => 'File Path',
            'size' => 'Size',
            'date_added' => 'Date Added',
        ];
    }
}
