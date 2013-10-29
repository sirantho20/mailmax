<?php

/**
 * This is the model class for table "account_subscription".
 *
 * The followings are the available columns in table 'account_subscription':
 * @property integer $id
 * @property integer $account
 * @property integer $package
 * @property string $signup_date
 * @property integer $duration_months
 * @property string $due_date
 *
 * The followings are the available model relations:
 * @property Account $account0
 * @property Package $package0
 */
class AccountSubscription extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AccountSubscription the static model class
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
		return 'account_subscription';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('signup_date, duration_months, due_date', 'required'),
			array('account, package, duration_months', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, account, package, signup_date, duration_months, due_date', 'safe', 'on'=>'search'),
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
			'account0' => array(self::BELONGS_TO, 'Account', 'account'),
			'package0' => array(self::BELONGS_TO, 'Package', 'package'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'account' => 'Account',
			'package' => 'Package',
			'signup_date' => 'Signup Date',
			'duration_months' => 'Duration Months',
			'due_date' => 'Due Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('account',$this->account);
		$criteria->compare('package',$this->package);
		$criteria->compare('signup_date',$this->signup_date,true);
		$criteria->compare('duration_months',$this->duration_months);
		$criteria->compare('due_date',$this->due_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}