<?php

/**
 * This is the model class for table "{{prescription}}".
 *
 * The followings are the available columns in table '{{prescription}}':
 * @property integer $id
 * @property integer $patient_account_id
 * @property integer $doctor_account_id
 * @property integer $consultation_id
 * @property string $prescription
 * @property string $date_of_prescription
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property Account $doctorAccount
 * @property Account $patientAccount
 * @property ConsultationRecord $consultation
 * @property Status $status
 */
class Prescription extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{prescription}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	// Inside Prescription.php
	public function rules()
    {
        return array(
            // 1. Prescription Text Required on Insert/Update
            array('prescription', 'required', 'on' => 'insert, update'), 
            
            // 2. Foreign Keys (IDs) must allow empty values during validation 
            // as the Controller assigns them *after* validation.
            array('patient_account_id, doctor_account_id, consultation_id, status_id', 'numerical', 'integerOnly'=>true, 'allowEmpty'=>true),
            
            // 3. System Assigned Date is Safe
            array('date_of_prescription', 'safe'), 

            // Search
            array('id, patient_account_id, doctor_account_id, consultation_id, prescription, date_of_prescription, status_id', 'safe', 'on'=>'search'),
        );
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'doctorAccount' => array(self::BELONGS_TO, 'Account', 'doctor_account_id'),
			'patientAccount' => array(self::BELONGS_TO, 'Account', 'patient_account_id'),
			'consultation' => array(self::BELONGS_TO, 'ConsultationRecord', 'consultation_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'patient_account_id' => 'Patient Account',
			'doctor_account_id' => 'Doctor Account',
			'consultation_id' => 'Consultation',
			'prescription' => 'Prescription',
			'date_of_prescription' => 'Date Of Prescription',
			'status_id' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('patient_account_id', $this->patient_account_id);
		$criteria->compare('doctor_account_id', $this->doctor_account_id);
		$criteria->compare('consultation_id', $this->consultation_id);
		$criteria->compare('prescription', $this->prescription, true);
		$criteria->compare('date_of_prescription', $this->date_of_prescription, true);
		$criteria->compare('status_id', $this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Prescription the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
