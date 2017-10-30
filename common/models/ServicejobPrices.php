<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_prices".
 *
 * @property integer $id
 * @property integer $servicejob_id
 * @property string $replacement_parts
 * @property integer $quantity
 * @property string $unit_price
 */
class ServicejobPrices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_prices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicejob_id', 'replacement_parts', 'quantity', 'unit_price'], 'required'],
            [['servicejob_id', 'quantity'], 'integer'],
            [['unit_price'], 'number'],
            [['replacement_parts'], 'string', 'max' => 50],
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
            'replacement_parts' => 'Replacement Parts',
            'quantity' => 'Quantity',
            'unit_price' => 'Unit Price',
        ];
    }
}
