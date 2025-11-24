<?php

/**
 * This is the model class for table "{{audit_log}}".
 *
 * The followings are the available columns in table '{{audit_log}}':
 * @property integer $id
 * @property integer $user_account_id
 * @property string $action
 * @property string $target_entity
 * @property integer $target_id
 * @property string $details
 * @property string $ip_address
 * @property string $timestamp
 *
 * The followings are the available model relations:
 * @property Account $userAccount
 */
class AuditLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{audit_log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_account_id, action, timestamp', 'required'),
			array('user_account_id, target_id', 'numerical', 'integerOnly'=>true),
			array('action', 'length', 'max'=>255),
			array('target_entity', 'length', 'max'=>100),
			array('ip_address', 'length', 'max'=>45),
			array('details', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_account_id, action, target_entity, target_id, details, ip_address, timestamp', 'safe', 'on'=>'search'),
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
			'account' => array(self::BELONGS_TO, 'Account', 'user_account_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_account_id' => 'User Account',
			'action' => 'Action',
			'target_entity' => 'Target Entity',
			'target_id' => 'Target',
			'details' => 'Details',
			'ip_address' => 'Ip Address',
			'timestamp' => 'Timestamp',
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
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('user_account_id',$this->user_account_id);
        $criteria->compare('action',$this->action,true);
        $criteria->compare('target_entity',$this->target_entity,true);
        $criteria->compare('target_id',$this->target_id);
        $criteria->compare('details',$this->details,true);
        $criteria->compare('ip_address',$this->ip_address,true);
        $criteria->compare('timestamp',$this->timestamp,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            
            // --- ADD THIS SORTING RULE ---
            'sort'=>array(
                'defaultOrder'=>'timestamp DESC', // Newest first
            ),
            
            'pagination'=>array(
                'pageSize'=>20, // Optional: Show 20 logs per page
            ),
        ));
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AuditLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
