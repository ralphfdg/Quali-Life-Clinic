<?php

/**
 * This is the model class for table "{{appointment}}".
 *
 * The followings are the available columns in table '{{appointment}}':
 * @property integer $id
 * @property integer $patient_account_id
 * @property integer $doctor_account_id
 * @property integer $booked_by_account_id
 * @property string $schedule_datetime
 * @property integer $appointment_status_id
 * @property string $notes
 * @property string $cancellation_reason
 * @property string $date_booked
 * @property integer $sms_reminder_sent
 * @property integer $email_reminder_sent
 *
 * The followings are the available model relations:
 * @property Account $bookedByAccount
 * @property Account $doctorAccount
 * @property Account $patientAccount
 * @property AppointmentStatus $appointmentStatus
 * @property Billing[] $billings
 * @property ConsultationRecord[] $consultationRecords
 */
class Appointment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{appointment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_account_id, doctor_account_id, schedule_datetime, date_booked', 'required'),
			array('patient_account_id, doctor_account_id, booked_by_account_id, appointment_status_id, sms_reminder_sent, email_reminder_sent', 'numerical', 'integerOnly'=>true),
			array('notes, cancellation_reason', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, patient_account_id, doctor_account_id, booked_by_account_id, schedule_datetime, appointment_status_id, notes, cancellation_reason, date_booked, sms_reminder_sent, email_reminder_sent', 'safe', 'on'=>'search'),
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
			'bookedByAccount' => array(self::BELONGS_TO, 'Account', 'booked_by_account_id'),
			'doctorAccount' => array(self::BELONGS_TO, 'Account', 'doctor_account_id'),
			'patientAccount' => array(self::BELONGS_TO, 'Account', 'patient_account_id'),
			'appointmentStatus' => array(self::BELONGS_TO, 'AppointmentStatus', 'appointment_status_id'),
			'billings' => array(self::HAS_MANY, 'Billing', 'appointment_id'),
			'consultationRecords' => array(self::HAS_MANY, 'ConsultationRecord', 'appointment_id'),
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
			'booked_by_account_id' => 'Booked By Account',
			'schedule_datetime' => 'Schedule Datetime',
			'appointment_status_id' => 'Appointment Status',
			'notes' => 'Notes',
			'cancellation_reason' => 'Cancellation Reason',
			'date_booked' => 'Date Booked',
			'sms_reminder_sent' => 'Sms Reminder Sent',
			'email_reminder_sent' => 'Email Reminder Sent',
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
		$criteria->compare('patient_account_id',$this->patient_account_id);
		$criteria->compare('doctor_account_id',$this->doctor_account_id);
		$criteria->compare('booked_by_account_id',$this->booked_by_account_id);
		$criteria->compare('schedule_datetime',$this->schedule_datetime,true);
		$criteria->compare('appointment_status_id',$this->appointment_status_id);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('cancellation_reason',$this->cancellation_reason,true);
		$criteria->compare('date_booked',$this->date_booked,true);
		$criteria->compare('sms_reminder_sent',$this->sms_reminder_sent);
		$criteria->compare('email_reminder_sent',$this->email_reminder_sent);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Appointment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
