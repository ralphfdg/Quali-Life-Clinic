<?php

/**
 * This is the model class for table "tbl_doctor_schedule".
 *
 * @property integer $id
 * @property integer $doctor_account_id
 * @property integer $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property integer $status_id
 *
 * The followings are the available model relations:
 * @property Account $doctorAccount
 * @property Status $status
 */
class DoctorSchedule extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DoctorSchedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_doctor_schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('doctor_account_id, day_of_week, start_time, end_time, status_id', 'required'),
			array('doctor_account_id, day_of_week, status_id', 'numerical', 'integerOnly'=>true),
			// Validate day is between 0 (Sunday) and 6 (Saturday)
			array('day_of_week', 'numerical', 'min'=>0, 'max'=>6),
			// Ensure safe attributes for search
			array('id, doctor_account_id, day_of_week, start_time, end_time, status_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'doctorAccount' => array(self::BELONGS_TO, 'Account', 'doctor_account_id'),
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
			'doctor_account_id' => 'Doctor',
			'day_of_week' => 'Day of Week',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'status_id' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('doctor_account_id',$this->doctor_account_id);
		$criteria->compare('day_of_week',$this->day_of_week);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('status_id',$this->status_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	// --- HELPER FUNCTIONS ---

	/**
	 * Helper to get day names
	 */
	public function getDayOptions()
	{
		return array(
			0 => 'Sunday',
			1 => 'Monday',
			2 => 'Tuesday',
			3 => 'Wednesday',
			4 => 'Thursday',
			5 => 'Friday',
			6 => 'Saturday',
		);
	}

	/**
	 * Returns the string name of the day for the current record
	 */
	public function getDayName()
	{
		$options = $this->getDayOptions();
		return isset($options[$this->day_of_week]) ? $options[$this->day_of_week] : 'Unknown';
	}
}