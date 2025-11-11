<?php

/**
 * This is the model class for table "{{account}}".
 *
 * The followings are the available columns in table '{{account}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email_address
 * @property string $salt
 * @property integer $account_type_id
 * @property integer $status_id
 * @property string $date_created
 * @property string $date_updated
 * @property string $expiration_date
 *
 * The followings are the available model relations:
 * (Relations are unchanged from Gii)
 */
class Account extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{account}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, account_type_id, status_id', 'required'),
			// Add 'required' rule for password only on create (isNewRecord)
			array('password', 'required', 'on'=>'insert'),
			array('account_type_id, status_id', 'numerical', 'integerOnly'=>true),
			array('username, password, salt', 'length', 'max'=>128),
			array('email_address', 'length', 'max'=>255),
			array('email_address', 'email'),
			array('username, email_address', 'unique'),
			array('expiration_date, password', 'safe'), // Allow password to be safe (can be empty on update)
			
			// The following rule is used by search().
			array('id, username, email_address, account_type_id, status_id, date_created', 'safe', 'on'=>'search'),
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
			'accountType' => array(self::BELONGS_TO, 'AccountType', 'account_type_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
			'user' => array(self::HAS_ONE, 'User', 'account_id'), // Added this for easy access to user profile
			'appointments' => array(self::HAS_MANY, 'Appointment', 'booked_by_account_id'),
			'appointments_doctor' => array(self::HAS_MANY, 'Appointment', 'doctor_account_id'),
			'appointments_patient' => array(self::HAS_MANY, 'Appointment', 'patient_account_id'),
			'auditLogs' => array(self::HAS_MANY, 'AuditLog', 'user_account_id'),
			'billings_created' => array(self::HAS_MANY, 'Billing', 'created_by_account_id'),
			'billings_patient' => array(self::HAS_MANY, 'Billing', 'patient_account_id'),
			'birthHistories' => array(self::HAS_MANY, 'BirthHistory', 'account_id'),
			'consultations_doctor' => array(self::HAS_MANY, 'ConsultationRecord', 'doctor_account_id'),
			'consultations_patient' => array(self::HAS_MANY, 'ConsultationRecord', 'patient_account_id'),
			'doctorSchedules' => array(self::HAS_MANY, 'DoctorSchedule', 'doctor_account_id'),
			'immunizationRecords' => array(self::HAS_MANY, 'ImmunizationRecord', 'account_id'),
			'prescriptions_doctor' => array(self::HAS_MANY, 'Prescription', 'doctor_account_id'),
			'prescriptions_patient' => array(self::HAS_MANY, 'Prescription', 'patient_account_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email_address' => 'Email Address',
			'salt' => 'Salt',
			'account_type_id' => 'Account Type',
			'status_id' => 'Status',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'expiration_date' => 'Expiration Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * (Search function remains as Gii generated it)
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		// (search criteria as Gii generated)
		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('account_type_id',$this->account_type_id);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	// --- CUSTOM FUNCTIONS ADDED ---

	/**
	 * Hashes the password with a salt.
	 */
	public function hashPassword($password, $salt)
	{
		return sha1($salt . $password);
	}

	/**
	 * Validates if the given password matches the one in the database.
	 */
	public function validatePassword($password)
	{
		return $this->password === $this->hashPassword($password, $this->salt);
	}
	
	/**
	 * This is invoked before the record is saved.
	 * We use it to hash the password and set timestamps.
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				// Set timestamps
				$this->date_created = new CDbExpression('NOW()');
				$this->date_updated = new CDbExpression('NOW()');
				
				// Generate salt and hash password
				$this->salt = time();
				$this->password = $this->hashPassword($this->password, $this->salt);
			}
			else
			{
				// Set updated timestamp
				$this->date_updated = new CDbExpression('NOW()');
				
				// If password was changed (form submitted a new password)
				// Check if password field is not empty
				if (!empty($this->password))
				{
					$this->salt = time();
					$this->password = $this->hashPassword($this->password, $this->salt);
				}
				else
				{
					// This prevents saving an empty password on update
					// We must retrieve the old password and set it
					$oldModel = Account::model()->findByPk($this->id);
					$this->password = $oldModel->password;
					$this->salt = $oldModel->salt;
				}
			}
			return true;
		}
		return false;
	}
}