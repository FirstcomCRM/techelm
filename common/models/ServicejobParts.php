<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servicejob_parts".
 *
 * @property integer $id
 * @property integer $servicejob_id
 * @property string $parts_name
 * @property string $quantity
 * @property string $unit_price
 * @property string $total_price
 * @property string $date_added
 */
class ServicejobParts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicejob_parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicejob_id', 'quantity'], 'integer'],
            [['parts_name', 'quantity', 'unit_price', 'total_price'], 'string'],
            [['unit_price', 'total_price', 'quantity'], 'required'],
            [['date_added'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'servicejob_id' => 'Service Job ID',
            'parts_name' => 'Parts Name',
            'quantity' => 'Quantity',
            'unit_price' => 'Unit Price',
            'total_price' => 'Total Price',
            'date_added' => 'Date Added',
        ];
    }

    public function getSerivce(){
      return $this->hasOne(Servicejob::className(), ['id' => 'servicejob_id']) ;
    }
}
