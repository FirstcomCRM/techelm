<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_complaint_fault".
 *
 * @property integer $id
 * @property integer $servicejob_category_id
 * @property string $complaint
 * @property string $date_created
 * @property integer $active
 */
class ServicejobComplaintFault extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_complaint_fault';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicejob_category_id', 'complaint', 'date_created'], 'required'],
            [['servicejob_category_id', 'active'], 'integer'],
            [['date_created'], 'safe'],
            [['complaint'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'servicejob_category_id' => 'Complaint Category',
            'complaint' => 'Complaint',
            'date_created' => 'Date Created',
            'active' => 'Active',
        ];
    }

    public function getServicejobCategory(){
        return $this->hasOne(ServicejobCategories::className(), ['id' => 'servicejob_category_id']);
    }
}
