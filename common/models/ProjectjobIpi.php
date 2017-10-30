<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projectjob_ipi".
 *
 * @property integer $id
 * @property integer $projectjob_id
 * @property string $sub_contractor
 * @property string $disposition_by
 * @property string $sub_c_-signature
 * @property string $dispo_by_siganture
 * @property string $sub_c_date
 * @property string $dispo_by_date
 * @property string $date_inspected
 * @property string $form_type
 */
class ProjectjobIpi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projectjob_ipi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_contractor', 'form_type'], 'required'],
            [['projectjob_id'], 'integer'],
            [['sub_contractor'], 'string', 'max' => 255],
            [['form_type'], 'string', 'max' => 5],
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
            'sub_contractor' => 'Sub Contractor',
            'disposition_by' => 'Disposition By',
            'sub_c_-signature' => 'Sub C  Signature',
            'dispo_by_siganture' => 'Dispo By Siganture',
            'sub_c_date' => 'Sub C Date',
            'dispo_by_date' => 'Dispo By Date',
            'date_inspected' => 'Date Inspected',
            'form_type' => 'Form Type',
        ];
    }
}
