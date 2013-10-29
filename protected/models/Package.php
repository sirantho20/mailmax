<?php

/**
 * This is the model class for table "package".
 *
 * The followings are the available columns in table 'package':
 * @property integer $id
 * @property string $package_name
 * @property integer $email_limit
 * @property integer $space_limit
 * @property integer $duration_months
 * @property double $package_price
 * @property integer $account
 *
 * The followings are the available model relations:
 * @property Account[] $accounts
 * @property Account $account0
 */
class Package extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Package the static model class
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
		return 'package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('package_name, email_limit, space_limit, duration_months, package_price', 'required'),
			array('email_limit, space_limit, duration_months, account', 'numerical', 'integerOnly'=>true),
			array('package_price', 'numerical'),
			array('package_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, package_name, email_limit, space_limit, duration_months, package_price, account', 'safe', 'on'=>'search'),
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
			'accounts' => array(self::HAS_MANY, 'Account', 'package'),
			'account0' => array(self::BELONGS_TO, 'Account', 'account'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'package_name' => 'Package Name',
			'email_limit' => 'Email Limit',
			'space_limit' => 'Space Limit',
			'duration_months' => 'Duration Months',
			'package_price' => 'Package Price',
			'account' => 'Account',
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
		$criteria->compare('package_name',$this->package_name,true);
		$criteria->compare('email_limit',$this->email_limit);
		$criteria->compare('space_limit',$this->space_limit);
		$criteria->compare('duration_months',$this->duration_months);
		$criteria->compare('package_price',$this->package_price);
		$criteria->compare('account',$this->account);
                $criteria->condition = "account = :ac";
                $criteria->params = array('ac'=>  Yii::app()->user->mainaccountid());

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public static function listPackages()
        {
            $model = Package::model()->findAllByAttributes(array('account'=> Yii::app()->user->isGuest?1:Yii::app()->user->id));//'account=:id',array('id'=>  Yii::app()->user->id));
            return CHtml::listData($model, 'id', 'package_name');
        }
        
        public function beforeValidate() {
            $this->account = $this->account0->id;
            return parent::beforeValidate();
        }
}