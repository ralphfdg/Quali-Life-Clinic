<?php

/**
 * This is the model class for table "{{billing}}".
 *
 * The followings are the available columns in table '{{billing}}':
 * @property integer $id
 * @property integer $appointment_id
 * @property integer $patient_account_id
 * @property string $amount
 * @property string $payment_status
 * @property string $date_created
 * @property string $date_paid
 * @property integer $created_by_account_id
 * @property string $notes
 *
 * The followings are the available model relations:
 * @property Account $createdByAccount
 * @property Account $patientAccount
 * @property Appointment $appointment
 */
class Billing extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{billing}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('appointment_id, patient_account_id, date_created, created_by_account_id', 'required'),
			array('appointment_id, patient_account_id, created_by_account_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>10),
			array('payment_status', 'length', 'max'=>7),
			array('date_paid, notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, appointment_id, patient_account_id, amount, payment_status, date_created, date_paid, created_by_account_id, notes', 'safe', 'on'=>'search'),
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
			'createdByAccount' => array(self::BELONGS_TO, 'Account', 'created_by_account_id'),
			'patientAccount' => array(self::BELONGS_TO, 'Account', 'patient_account_id'),
			'appointment' => array(self::BELONGS_TO, 'Appointment', 'appointment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'appointment_id' => 'Appointment',
			'patient_account_id' => 'Patient Account',
			'amount' => 'Amount',
			'payment_status' => 'Payment Status',
			'date_created' => 'Date Created',
			'date_paid' => 'Date Paid',
			'created_by_account_id' => 'Created By Account',
			'notes' => 'Notes',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('appointment_id',$this->appointment_id);
		$criteria->compare('patient_account_id',$this->patient_account_id);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('payment_status',$this->payment_status,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_paid',$this->date_paid,true);
		$criteria->compare('created_by_account_id',$this->created_by_account_id);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Billing the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
