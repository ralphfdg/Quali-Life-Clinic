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
			// REMOVED 'date_booked' from the required list below
			array('patient_account_id, doctor_account_id, schedule_datetime', 'required'),
			array('patient_account_id, doctor_account_id, booked_by_account_id, appointment_status_id, sms_reminder_sent, email_reminder_sent', 'numerical', 'integerOnly' => true),
			array('notes, cancellation_reason', 'safe'),
			// The following rule is used by search().
			array('id, patient_account_id, doctor_account_id, booked_by_account_id, schedule_datetime, appointment_status_id, notes, cancellation_reason, date_booked, sms_reminder_sent, email_reminder_sent', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'bookedByAccount' => array(self::BELONGS_TO, 'Account', 'booked_by_account_id'),
			'doctorAccount' => array(self::BELONGS_TO, 'Account', 'doctor_account_id'),
			'patientAccount' => array(self::BELONGS_TO, 'Account', 'patient_account_id'),
			'appointmentStatus' => array(self::BELONGS_TO, 'AppointmentStatus', 'appointment_status_id'),
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
	 */
	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('patient_account_id', $this->patient_account_id);
		$criteria->compare('doctor_account_id', $this->doctor_account_id);
		$criteria->compare('booked_by_account_id', $this->booked_by_account_id);
		$criteria->compare('schedule_datetime', $this->schedule_datetime, true);
		$criteria->compare('appointment_status_id', $this->appointment_status_id);
		$criteria->compare('notes', $this->notes, true);
		$criteria->compare('cancellation_reason', $this->cancellation_reason, true);
		$criteria->compare('date_booked', $this->date_booked, true);
		$criteria->compare('sms_reminder_sent', $this->sms_reminder_sent);
		$criteria->compare('email_reminder_sent', $this->email_reminder_sent);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	// --- ADDED THIS FUNCTION TO FIX SAVING ---
	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			if ($this->isNewRecord) {
				// Automatically set the booking date to NOW
				$this->date_booked = date('Y-m-d H:i:s');

				// Ensure status is set to 1 (Scheduled) if not provided
				if (empty($this->appointment_status_id)) {
					$this->appointment_status_id = 1;
				}
			}
			return true;
		}
		return false;
	}

	protected function afterSave()
    {
        parent::afterSave();

        // --- FIX: USE ALIASES TO AVOID SQL ERROR ---
        // We use explicit aliases ('pUser' and 'dUser') so SQL knows 
        // which table is the patient and which is the doctor.
        $appt = Appointment::model()->with(array(
            'patientAccount' => array(
                'with' => array(
                    'user' => array('alias' => 'pUser') 
                )
            ),
            'doctorAccount' => array(
                'with' => array(
                    'user' => array('alias' => 'dUser')
                )
            )
        ))->findByPk($this->id);
        
        // Safety exit if data is missing
        if(!$appt || !isset($appt->patientAccount->user) || !isset($appt->doctorAccount->user)) {
            return; 
        }

        $patientUser = $appt->patientAccount->user;
        $doctorUser = $appt->doctorAccount->user;
        
        $mobile = $patientUser->mobile_number;
        // Add check to ensure names exist
        $patientName = ucfirst($patientUser->firstname);
        $doctorName = ucfirst($doctorUser->lastname);

        // --- TRIGGER 1: NEW APPOINTMENT (CONFIRMATION) ---
        if ($this->isNewRecord && !empty($mobile)) 
        {
            $date = date('M j, Y', strtotime($this->schedule_datetime)); // Nov 24, 2025
            $time = date('g:i A', strtotime($this->schedule_datetime));  // 9:30 AM
            
            // SMS TEMPLATE
            $msg = "Quali-Life: Hello $patientName, your appointment is CONFIRMED.\n\n"
                 . "Dr. $doctorName\n"
                 . "$date @ $time\n\n"
                 . "See you soon!";
            
            SmsHelper::send($mobile, $msg);
        }

        // --- TRIGGER 2: CANCELLATION ---
        if (!$this->isNewRecord && $this->appointment_status_id == 5 && !empty($mobile)) 
        {
            $date = date('F j', strtotime($this->schedule_datetime)); // November 24
            $time = date('g:i A', strtotime($this->schedule_datetime));

            // SMS TEMPLATE
            $msg = "Quali-Life: Hi $patientName, your appointment with Dr. $doctorName on $date ($time) has been CANCELED.\n\n"
                 . "Please contact us if you wish to reschedule.";
            
            SmsHelper::send($mobile, $msg);
        }
    }
}
