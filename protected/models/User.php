<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property integer $account_id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $qualifier
 * @property string $dob
 * @property string $specialization
 * @property integer $specialization_id
 * @property string $ptr_number
 * @property string $license_number
 * @property string $license_expiration
 * @property string $s2_number
 * @property string $s2_expiration
 * @property string $maxicare_number
 * @property string $address
 * @property string $name_of_father
 * @property string $father_dob
 * @property string $name_of_mother
 * @property string $mother_dob
 * @property string $school
 * @property integer $gender
 * @property string $mother_contact_number
 * @property string $father_contact_number
 *
 * The followings are the available model relations:
 * @property Account $account
 * @property Specialization $specialization0
 */
class User extends CActiveRecord
{

	public $account_type_filter;
	 public $globalSearch;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account_id, firstname, lastname, dob, gender', 'required'),
			array('account_id, specialization_id, gender', 'numerical', 'integerOnly'=>true),
			array('firstname, middlename, lastname, qualifier, ptr_number, license_number, s2_number, maxicare_number, name_of_father, name_of_mother, school', 'length', 'max'=>128),
			array('specialization, address', 'length', 'max'=>255),
			array('mother_contact_number, father_contact_number', 'length', 'max'=>11),
			array('license_expiration, s2_expiration, father_dob, mother_dob', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account_id, firstname, middlename, lastname, qualifier, dob, specialization, specialization_id, ptr_number, license_number, license_expiration, s2_number, s2_expiration, maxicare_number, address, name_of_father, father_dob, name_of_mother, mother_dob, school, gender, mother_contact_number, father_contact_number, account_type_filter', 'safe', 'on'=>'search'),
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
			'account' => array(self::BELONGS_TO, 'Account', 'account_id'),
			'specialization' => array(self::BELONGS_TO, 'Specialization', 'specialization_id'),
		);
	}


	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'account_id' => 'Account',
			'firstname' => 'Firstname',
			'middlename' => 'Middlename',
			'lastname' => 'Lastname',
			'qualifier' => 'Qualifier',
			'dob' => 'Dob',
			'specialization' => 'Specialization',
			'specialization_id' => 'Specialization',
			'ptr_number' => 'Ptr Number',
			'license_number' => 'License Number',
			'license_expiration' => 'License Expiration',
			's2_number' => 'S2 Number',
			's2_expiration' => 'S2 Expiration',
			'maxicare_number' => 'Maxicare Number',
			'address' => 'Address',
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

		$criteria->with = array('account');

		$criteria->compare('id',$this->id);
		$criteria->compare('account_id',$this->account_id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('middlename',$this->middlename,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('qualifier',$this->qualifier,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('specialization',$this->specialization,true);
		$criteria->compare('specialization_id',$this->specialization_id);
		$criteria->compare('ptr_number',$this->ptr_number,true);
		$criteria->compare('license_number',$this->license_number,true);
		$criteria->compare('license_expiration',$this->license_expiration,true);
		$criteria->compare('s2_number',$this->s2_number,true);
		$criteria->compare('s2_expiration',$this->s2_expiration,true);
		$criteria->compare('maxicare_number',$this->maxicare_number,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('name_of_father',$this->name_of_father,true);
		$criteria->compare('father_dob',$this->father_dob,true);
		$criteria->compare('name_of_mother',$this->name_of_mother,true);
		$criteria->compare('mother_dob',$this->mother_dob,true);
		$criteria->compare('school',$this->school,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('mother_contact_number',$this->mother_contact_number,true);
		$criteria->compare('father_contact_number',$this->father_contact_number,true);

		if(!empty($this->account_type_filter)) {
			$criteria->compare('account.account_type_id', $this->account_type_filter);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
