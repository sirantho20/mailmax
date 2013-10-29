<?php

/**
 * This is the model class for table "domain".
 *
 * The followings are the available columns in table 'domain':
 * @property integer $id
 * @property string $domainName
 * @property integer $account
 * @property string $created
 * @property string $vhost
 *
 * The followings are the available model relations:
 * @property Account $account0
 */
class Domain extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Domain the static model class
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
		return 'domain';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('domainName,vhost','required'),
			array('account', 'numerical', 'integerOnly'=>true),
			array('domainName, vhost', 'length', 'max'=>45),
			array('created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, domainName, account, created, vhost', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'domainName' => 'Domain Name',
			'account' => 'Account',
			'created' => 'Created',
			'vhost' => 'Virtual Host (e.g. mail.domain.com)',
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
		$criteria->compare('domainName',$this->domainName,true);
		$criteria->compare('account',$this->account);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('vhost',$this->vhost,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeValidate() {
            $this->created = new CDbExpression('now()');
            $this->account = Yii::app()->user->account;
           return parent::beforeValidate();
        }
        public static function getDomains()
        {
            $domains = Domain::model()->findAllByAttributes(array('account'=>  Yii::app()->user->account));
            return CHtml::listData($domains, 'domainName', 'domainName');
        }
}