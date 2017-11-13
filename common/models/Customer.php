<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $fullname
 * @property string $person_in_charge
 * @property string $job_site
 * @property string $address
 * @property string $email
 * @property string $contact_no
 * @property string $phone_no
 * @property string $race
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'person_in_charge', 'address','contact_no', 'phone_no', 'status', 'username','password','usergroup'], 'required'],
            [['job_site', 'address'], 'string'],
            [['status', 'created_by', 'updated_by', 'phone_no'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['email','email_2','email_3','email_4'], 'email'],
            [['username'], 'unique'],
            [['fullname', 'person_in_charge', 'email'], 'string', 'max' => 100],
            [['contact_no', 'phone_no', 'race' ,'fax'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'person_in_charge' => 'Person In Charge',
            'job_site' => 'Job Site',
            'address' => 'Address',
            'email' => 'Email',
            'email_2'=>'Email 2',
            'email_3'=>'Email 3',
            'email_4'=> 'Email 4',
            'contact_no' => 'Contact No',
            'phone_no' => 'Phone No',
            'fax'=>'Fax',
            'race' => 'Race',
            'status' => 'Status',
            'username'=>'Username',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
