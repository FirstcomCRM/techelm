<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $service_name
 * @property string $description
 * @property double $default_unit_price
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'service_name', 'description', 'status', 'created_at', 'created_by', 'updated_by'], 'required'],
            [['category_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['default_unit_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['service_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Service Type',
            'service_name' => 'Service Name',
            'description' => 'Description',
            'default_unit_price' => 'Default Unit Price',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    public function getServiceCategory(){
        return $this->hasOne(ServiceCategory::className(), ['id' => 'category_id']);
    }

}
