<?php

/**
 * This is the model class for table "email_accounts".
 *
 * The followings are the available columns in table 'email_accounts':
 * @property string $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $email
 * @property string $created
 * @property double $quota
 * @property integer $account
 * @property string $job_title
 * @property string $department
 * @property string $office
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Account $account0
 */
class EmailAccounts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailAccounts the static model class
	 */
        public $password;
        public $lastlogon;
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'email_accounts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('quota,first_name,last_name,email', 'required'),
                        array('password','required','on'=>'create'),
			array('account', 'numerical', 'integerOnly'=>true),
			array('quota', 'numerical'),
			array('first_name, middle_name, last_name, email, job_title, department, office', 'length', 'max'=>45),
			array('created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, middle_name, last_name, email, created, quota, account, job_title, department, office', 'safe', 'on'=>'search'),
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
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'email' => 'Email Address',
			'created' => 'Created',
			'quota' => 'Disk Quota',
			'account' => 'Account',
			'job_title' => 'Job Title',
			'department' => 'Department',
			'office' => 'Office',
                        'lastlogon'=>'Last Login',
                        'status'=>'Status',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('quota',$this->quota);
		$criteria->compare('account',$this->account);
		$criteria->compare('job_title',$this->job_title,true);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('office',$this->office,true);
                $criteria->condition = "account = :ac";
                $criteria->params = array('ac'=>  Yii::app()->user->mainaccountid());
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function beforeValidate() {
            $this->account = Yii::app()->user->mainaccountid();
            $this->created = new CDbExpression('now()');
            $this->scenario=='create'?$this->status='active':'';
            //$this->email = $this->email.'@'.Yii::app()->user->accountdomain;
            return parent::beforeValidate();
        }
        
        public function afterFind() {
            $zm = new yiiZimbra();
            //$this->status = $zm->getAccountStatus($this->email);
            //split email
            $this->lastlogon = $zm->getAccountLastLoginDate($this->email);
            //$lastlogon==""?$this->lastlogon='never loged in':$this->lastlogon = $lastlogon;
            //$this->lastlogon==""?$this->lastlogon = 'never loged in':'';
            $m = explode('@', $this->email);
            $this->email = $m[0];
            return parent::afterFind();
        }
        
        public function beforeDelete() {
            $zm = new yiiZimbra();
            if($zm->deleteAccount($this->email))
            {
                return TRUE;
            }
            else 
            {
                return false;
            }
            parent::beforeDelete();
        }
        
        
}