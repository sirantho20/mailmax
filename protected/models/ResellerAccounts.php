<?php

/**
 * This is the model class for table "resellerAccounts".
 *
 * The followings are the available columns in table 'resellerAccounts':
 * @property integer $id
 * @property string $business_name
 * @property integer $reseller_package
 * @property string $email
 * @property string $mobile
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Account[] $accounts
 * @property ResellerPackages $resellerPackage
 * @property ResellerInvoice[] $resellerInvoices
 */
class ResellerAccounts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResellerAccounts the static model class
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
		return 'resellerAccounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, reseller_package', 'numerical', 'integerOnly'=>true),
			array('business_name, email, mobile', 'length', 'max'=>45),
			array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, business_name, reseller_package, email, mobile, status', 'safe', 'on'=>'search'),
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
			'accounts' => array(self::HAS_MANY, 'Account', 'resellerAccount'),
			'resellerPackage' => array(self::BELONGS_TO, 'ResellerPackages', 'reseller_package'),
			'resellerInvoices' => array(self::HAS_MANY, 'ResellerInvoice', 'reseller_account'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'business_name' => 'Business Name',
			'reseller_package' => 'Reseller Package',
			'email' => 'Email',
			'mobile' => 'Mobile',
			'status' => 'Status',
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
		$criteria->compare('business_name',$this->business_name,true);
		$criteria->compare('reseller_package',$this->reseller_package);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}