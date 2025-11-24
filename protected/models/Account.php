<?php

class Account extends CActiveRecord
{
	// Added properties for password handling
	public $retypepassword;
	public $oldpassword;
	public $newpassword;

	public function tableName()
	{
		return '{{account}}';
	}

	public function rules()
	{
		return array(
			// --- STANDARD REQUIRED FIELDS (Everyone) ---
			array('firstname, lastname, dob, gender, mobile_number', 'required'),

			// --- DOCTOR SPECIFIC RULES (Enforced via Scenarios) ---
			// These are only required if we are creating/updating a Doctor
			array('specialization_id, license_number, ptr_number', 'required', 'on' => 'createNewDoctor, updateDoctor'),

			// --- DATA TYPES & LENGTHS ---
			array('account_id, specialization_id, gender', 'numerical', 'integerOnly' => true),
			array('firstname, middlename, lastname, qualifier, ptr_number, license_number, s2_number, maxicare_number, name_of_father, name_of_mother, school', 'length', 'max' => 128),
			array('specialization, address', 'length', 'max' => 255),
			array('mother_contact_number, father_contact_number', 'length', 'max' => 11),

			// Dates
			array('license_expiration, s2_expiration, father_dob, mother_dob', 'safe'),

			// Mobile Number Validation
			array('mobile_number', 'match', 'pattern' => '/^[0-9\+\-]+$/', 'message' => 'Invalid Phone Number'),

			// Search
			array('id, firstname, lastname, mobile_number', 'safe', 'on' => 'search'),
		);
	}

	// ... (Keep relations, attributeLabels, search, model methods SAME as before) ...
	public function relations()
	{
		return array(
			'accountType' => array(self::BELONGS_TO, 'AccountType', 'account_type_id'),
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
			'user' => array(self::HAS_ONE, 'User', 'account_id'),
			// ... add other relations if needed ...
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'retypepassword' => 'Retype Password', // Added Label
			'email_address' => 'Email Address',
			'account_type_id' => 'Account Type',
			'status_id' => 'Status',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('email_address', $this->email_address, true);
		$criteria->compare('account_type_id', $this->account_type_id);
		$criteria->compare('status_id', $this->status_id);
		return new CActiveDataProvider($this, array('criteria' => $criteria));
	}

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	// --- CUSTOM VALIDATION FUNCTIONS ---

	public function validateNewUsername($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$account = Account::model()->find('username=?', array($this->username));
			if ($account !== null)
				$this->addError('username', 'Username entered is already in use.');
		}
	}

	public function validateNewEmailAddress($attribute, $params)
	{
		if (!$this->hasErrors() && !empty($this->email_address)) {
			$account = Account::model()->find('email_address=?', array($this->email_address));
			if ($account !== null)
				$this->addError('email_address', 'Email address entered is already in use.');
		}
	}

	// --- PASSWORD HASHING ---

	public function hashPassword($password, $salt)
	{
		return sha1($password . $salt);
	}

	public function validatePassword($password)
	{
		return $this->password === $this->hashPassword($password, $this->salt);
	}

	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			if ($this->isNewRecord) {
				$this->date_created = new CDbExpression('NOW()');
				$this->date_updated = new CDbExpression('NOW()');
				$this->salt = time();
				$this->password = $this->hashPassword($this->password, $this->salt);
			} else {
				$this->date_updated = new CDbExpression('NOW()');
				// Only update password if user typed something new
				if (!empty($this->password) && $this->password !== $this->oldAttributes['password']) {
					$this->salt = time();
					$this->password = $this->hashPassword($this->password, $this->salt);
				}
			}
			return true;
		}
		return false;
	}
}
