<?php

/**
 * This is the model class for table "{{user}}".
 */
class User extends CActiveRecord
{
	// Added these public properties for search filtering
	public $account_type_filter;
	public $globalSearch;

	public function tableName()
	{
		return '{{user}}';
	}

	public function rules()
	{
		return array(
			array('firstname, lastname, dob, gender, mobile_number', 'required'),

			array('account_id, specialization_id, gender', 'numerical', 'integerOnly' => true),
			array('firstname, middlename, lastname, qualifier, ptr_number, license_number, s2_number, maxicare_number, name_of_father, name_of_mother, school', 'length', 'max' => 128),
			array('specialization, address', 'length', 'max' => 255),
			array('mother_contact_number, father_contact_number', 'length', 'max' => 11),
			array('license_expiration, s2_expiration, father_dob, mother_dob', 'safe'),

			// Validates that mobile_number contains only numbers, +, and -
			array('mobile_number', 'match', 'pattern' => '/^[0-9\+\-]+$/', 'message' => 'Invalid Phone Number'),

			// Search rules
			array('id, account_id, firstname, middlename, lastname, qualifier, dob, specialization, specialization_id, ptr_number, license_number, license_expiration, s2_number, s2_expiration, maxicare_number, address, name_of_father, father_dob, name_of_mother, mother_dob, school, gender, mother_contact_number, father_contact_number, account_type_filter', 'safe', 'on' => 'search'),
		);
	}

	public function relations()
	{
		return array(
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			
            'specializationInfo' => array(self::BELONGS_TO, 'Specialization', 'specialization_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'account_id' => 'Account',
			'firstname' => 'Firstname',
			'middlename' => 'Middlename',
			'lastname' => 'Lastname',
			'qualifier' => 'Qualifier',
			'dob' => 'Date of Birth',
			'specialization' => 'Specialization',
			'specialization_id' => 'Specialization',
			'ptr_number' => 'Ptr Number',
			'license_number' => 'License Number',
			'license_expiration' => 'License Expiration',
			's2_number' => 'S2 Number',
			's2_expiration' => 'S2 Expiration',
			'maxicare_number' => 'Maxicare Number',
			'address' => 'Address',
			'mobile_number' => 'Mobile Number', // Added label
			'name_of_father' => 'Name Of Father',
			'father_dob' => 'Father Dob',
			'name_of_mother' => 'Name Of Mother',
			'mother_dob' => 'Mother Dob',
			'school' => 'School',
			'gender' => 'Gender',
			'mother_contact_number' => 'Mother Contact Number',
			'father_contact_number' => 'Father Contact Number',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->with = array('account');

		$criteria->compare('id', $this->id);
		$criteria->compare('account_id', $this->account_id);
		$criteria->compare('firstname', $this->firstname, true);
		$criteria->compare('middlename', $this->middlename, true);
		$criteria->compare('lastname', $this->lastname, true);
		$criteria->compare('qualifier', $this->qualifier, true);
		$criteria->compare('dob', $this->dob, true);
		$criteria->compare('specialization', $this->specialization, true);
		$criteria->compare('specialization_id', $this->specialization_id);
		$criteria->compare('ptr_number', $this->ptr_number, true);
		$criteria->compare('license_number', $this->license_number, true);
		$criteria->compare('license_expiration', $this->license_expiration, true);
		$criteria->compare('s2_number', $this->s2_number, true);
		$criteria->compare('s2_expiration', $this->s2_expiration, true);
		$criteria->compare('maxicare_number', $this->maxicare_number, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('mobile_number', $this->mobile_number, true); // Added search
		$criteria->compare('name_of_father', $this->name_of_father, true);
		$criteria->compare('father_dob', $this->father_dob, true);
		$criteria->compare('name_of_mother', $this->name_of_mother, true);
		$criteria->compare('mother_dob', $this->mother_dob, true);
		$criteria->compare('school', $this->school, true);
		$criteria->compare('gender', $this->gender);
		$criteria->compare('mother_contact_number', $this->mother_contact_number, true);
		$criteria->compare('father_contact_number', $this->father_contact_number, true);

		if (!empty($this->account_type_filter)) {
			$criteria->compare('account.account_type_id', $this->account_type_filter);
		}

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
     * Normalize Name Capitalization before saving to DB
     */
   /**
     * Normalize Name Capitalization before saving to DB
     */
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            // 1. Standardize User's Name (e.g. "john doe" -> "John Doe")
            $this->firstname = ucwords(strtolower($this->firstname));
            $this->lastname = ucwords(strtolower($this->lastname));
            $this->middlename = ucwords(strtolower($this->middlename));
            
            // 2. Standardize Qualifier (e.g. "jr." -> "Jr.")
            if(!empty($this->qualifier)) {
                $this->qualifier = ucfirst(strtolower($this->qualifier));
            }

            // 3. Standardize Parents' Names (NEW)
            if(!empty($this->name_of_father)) {
                $this->name_of_father = ucwords(strtolower($this->name_of_father));
            }
            if(!empty($this->name_of_mother)) {
                $this->name_of_mother = ucwords(strtolower($this->name_of_mother));
            }
            
            return true;
        }
        return false;
    }
}
