<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "toolboxmeeting".
 *
 * @property integer $id
 * @property integer $projectjob_id
 * @property string $meeting_image
 * @property string $image_uploaded_date
 * @property string $meeting_details
 * @property string $conducted_by
 * @property string $designation
 * @property string $signature
 * @property integer $status_flag
 * @property string $date_added
 * @property string $site_address
 */
class Toolboxmeeting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'toolboxmeeting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_address', 'conducted_by'], 'required'],
            [['projectjob_id', 'status_flag_tm'], 'integer'],
            [['image_uploaded_date', 'date_added'], 'safe'],
            [['meeting_image', 'conducted_by', 'signature'], 'string', 'max' => 255],
            [['meeting_details'], 'string', 'max' => 500],
            [['site_address'],'string'],
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
            'meeting_image' => 'Meeting Image',
            'image_uploaded_date' => 'Image Uploaded Date',
            'meeting_details' => 'Meeting Details',
            'conducted_by' => 'Conducted By',
            'signature' => 'Signature',
            'status_flag_tm' => 'Status Flag',
            'date_added' => 'Date Added',
            'site_address'=>'Site Address'
        ];
    }
}
