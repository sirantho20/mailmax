<?php

/**
 * This is the model class for table "resellerPackages".
 *
 * The followings are the available columns in table 'resellerPackages':
 * @property integer $id
 * @property string $packageName
 * @property integer $space_limit
 * @property integer $duration_months
 * @property integer $domain_limit
 * @property double $package_price
 * @property integer $resellerAccount
 * @property integer $account_limit
 *
 * The followings are the available model relations:
 * @property ResellerAccounts[] $resellerAccounts
 */
class ResellerPackages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResellerPackages the static model class
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
		return 'resellerPackages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('space_limit, duration_months, domain_limit, resellerAccount, account_limit', 'numerical', 'integerOnly'=>true),
			array('package_price', 'numerical'),
			array('packageName', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, packageName, space_limit, duration_months, domain_limit, package_price, resellerAccount, account_limit', 'safe', 'on'=>'search'),
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
			'resellerAccounts' => array(self::HAS_MANY, 'ResellerAccounts', 'reseller_package'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'packageName' => 'Package Name',
			'space_limit' => 'Space Limit',
			'duration_months' => 'Duration Months',
			'domain_limit' => 'Domain Limit',
			'package_price' => 'Package Price',
			'resellerAccount' => 'Reseller Account',
			'account_limit' => 'Account Limit',
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
		$criteria->compare('packageName',$this->packageName,true);
		$criteria->compare('space_limit',$this->space_limit);
		$criteria->compare('duration_months',$this->duration_months);
		$criteria->compare('domain_limit',$this->domain_limit);
		$criteria->compare('package_price',$this->package_price);
		$criteria->compare('resellerAccount',$this->resellerAccount);
		$criteria->compare('account_limit',$this->account_limit);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}