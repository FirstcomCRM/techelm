<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $company_name
 * @property string $address
 * @property string $email
 * @property integer $telephone
 * @property integer $postal_code
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_name', 'address', 'email', 'telephone', 'postal_code'], 'required'],
            [['address'], 'string'],
            [['postal_code'], 'integer'],
            [['company_name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['website'], 'string', 'max' => 75],
            [['telephone','fax'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => 'Company Name',
            'address' => 'Address',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'fax'=>'Fax',
            'website'=>'Website',
            'postal_code' => 'Postal Code',
        ];
    }
}
