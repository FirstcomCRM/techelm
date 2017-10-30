<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "service_partslist".
 *
 * @property integer $id
 * @property integer $service_id
 * @property string $parts_id
 * @property double $price
 * @property integer $quantity
 * @property double $unit_price
 * @property string $service_condition
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class ServicePartslist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_partslist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'parts_id', 'price', 'quantity', 'unit_price', 'service_condition', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['service_id', 'quantity', 'status', 'created_by', 'updated_by'], 'integer'],
            [['price', 'unit_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['parts_id'], 'string', 'max' => 100],
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
            'parts_id' => 'Parts ID',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'unit_price' => 'Unit Price',
            'service_condition' => 'Service Condition',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
