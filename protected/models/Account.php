<?php

class Account extends CActiveRecord
{
	// Virtual attributes for forms
	public $retypepassword;
	public $oldpassword;
	public $newpassword;

	public $oldAttributes = array();

	public function tableName()
	{
		return '{{account}}';
	}

	public function rules()
	{
		return array(
			// 1. REQUIRED FIELDS
			array('username, account_type_id, status_id, email_address', 'required'),

			// 2. PASSWORD SECURITY
			// Required on insert
			array('password, retypepassword', 'required', 'on' => 'insert'),
			// Match retype
			array('retypepassword', 'compare', 'compareAttribute' => 'password', 'on' => 'insert', 'message' => 'Passwords do not match.'),

			// --- NEW: STRONG PASSWORD RULES ---
			// Minimum 8 characters
			array('password', 'length', 'min' => 8, 'allowEmpty' => true, 'message' => 'Password must be at least 8 characters.'),
			// Must contain at least one Letter AND one Number
			array('password', 'match', 'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!@#$%^&*]{8,}$/', 'message' => 'Password must contain at least 1 letter and 1 number.'),

			// 3. EMAIL VALIDATION (Real Domain Check)
			array('email_address', 'email', 'checkMX' => true, 'message' => 'Please enter a valid email address.'),

			// 4. UNIQUE CHECKS
			array('username', 'unique', 'message' => 'This username is taken.'),
			array('email_address', 'unique', 'message' => 'This email is already registered.'),

			// 5. DATA TYPES
			array('account_type_id, status_id', 'numerical', 'integerOnly' => true),
			array('username, email_address', 'length', 'max' => 128),

			// 6. SEARCH
			array('id, username, email_address, account_type_id, status_id', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			// Links Account -> Account Type (e.g., "Doctor", "Patient")
			'accountType' => array(self::BELONGS_TO, 'AccountType', 'account_type_id'),

			// Links Account -> Status (e.g., "Active", "Inactive")
			'status' => array(self::BELONGS_TO, 'Status', 'status_id'),

			// CRITICAL: Links Account -> User Profile (Firstname, Address, Specialization)
			'user' => array(self::HAS_ONE, 'User', 'account_id'),
		);
	}

	// --- PASSWORD HASHING LOGIC ---
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
                // ... (creation logic) ...
                $this->date_created = new CDbExpression('NOW()');
                $this->date_updated = new CDbExpression('NOW()');
                $this->salt = time();
                $this->password = $this->hashPassword($this->password, $this->salt);
            } else {
                $this->date_updated = new CDbExpression('NOW()');
                
                // FIX: Check if password field is not empty AND different from old password
                if (!empty($this->password) && $this->password !== $this->oldAttributes['password']) {
                    $this->salt = time();
                    $this->password = $this->hashPassword($this->password, $this->salt);
                }
            }
            return true;
        }
        return false;
    }

	protected function afterFind()
    {
        parent::afterFind();
        // Store the current attributes as "old"
        $this->oldAttributes = $this->attributes;
    }

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'retypepassword' => 'Retype Password',
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
}
