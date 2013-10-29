<?php

/**
 * This is the model class for table "account".
 *
 * The followings are the available columns in table 'account':
 * @property integer $id
 * @property string $business_name
 * @domain string $domain
 * @vhost string $vhost
 * @property integer $package
 * @property string $email
 * @property integer $mobile
 * @property string $signup_date
 * @property string $status
 * @property string $cos
 * @property integer $resellerAccount
 *
 * The followings are the available model relations:
 * @property Package $package0
 * @property ResellerAccounts $resellerAccount
 * @property EmailAccounts[] $emailAccounts
 * @property Invoice[] $invoices
 * @property Users[] $users
 */
class Account extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Account the static model class
	 */
        //public $validation;
        public $duration = 12;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'account';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('package, mobile, duration, resellerAccount', 'numerical', 'integerOnly'=>true),
                        array('package, resellerAccount, duration, business_name,domain,email', 'required'),
                        array('email','email'),
                        arrAY('domain','unique'),
                        array('domain','domainExists'),
			array('business_name, cos', 'length', 'max'=>45),
			array('email', 'length', 'max'=>50),
			array('status', 'length', 'max'=>1),
			array('signup_date', 'safe'),
                        /*array('validation', 
                                'application.extensions.recaptcha.EReCaptchaValidator', 
                                'privateKey'=>'6LdyAeQSAAAAANY-9jBwcs3qec4_f7tvzcZ2J9iV','on' => 'registerwcaptcha'),*/
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, business_name, package, email, mobile, signup_date, status, cos, resellerAccount', 'safe', 'on'=>'search'),
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
			'account_package' => array(self::BELONGS_TO, 'Package', 'package'),
			'resellerAccount' => array(self::BELONGS_TO, 'ResellerAccounts', 'resellerAccount'),
			'emailAccounts' => array(self::HAS_MANY, 'EmailAccounts', 'account'),
			'invoices' => array(self::HAS_MANY, 'Invoice', 'account'),
			'users' => array(self::HAS_MANY, 'Users', 'account'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'business_name' => 'Business/Account Name',
			'package' => 'Account Package',
			'email' => 'Email Address',
			'mobile' => 'Mobile Number',
			'signup_date' => 'Signup Date',
			'status' => 'Status',
			'cos' => 'Cos',
			'resellerAccount' => 'Reseller Account',
                        'domain' => 'Domain Name',
                        'duration'=>'Subscription Plan',
                        'vhost' => 'Virtual Host',
                        'validacion'=>Yii::t('demo', 'Enter both words separated by a space: '),
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
		$criteria->compare('package',$this->package);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('signup_date',$this->signup_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('cos',$this->cos,true);
		$criteria->compare('resellerAccount',$this->resellerAccount);
                $criteria->condition = "resellerAccount = :ac";
                $criteria->params = array('ac'=>  Yii::app()->user->reselleraccountid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function domainExists()
        {
                        if(checkdnsrr($this->domain, 'NS'))
                        {
                            return true;
                        }
                        else
                        {
                            $this->addError('domain', 'Sorry, '.$this->domain.' is not a registered domain');
                        }
            
        }
        
        public function getAccountUsers($id)
        {
            $crit = new CDbCriteria();
            $crit->condition = "account = :ac";
            $crit->params = array('ac'=>$id);
            
            return new CActiveDataProvider(new Users(),array('criteria'=>$crit));
        }
        public function beforeValidate() {
            if(!Yii::app()->user->isGuest)
            {
            $this->resellerAccount = Yii::app()->user->mainaccountid();
            }
            
            return parent::beforeValidate();
        }
        
        public function afterSave() 
        {
            if($this->isNewRecord)
            {
                $sub = new AccountSubscription();
                $sub->account = $this->id;
                $sub->package = $this->package;
                $sub->signup_date = new CDbExpression('now()');
                $due = $this->duration + 1;
                $sub->duration_months = $due;
                $sub->due_date = new CDbExpression("date_add(now(),interval $due month)");
                $sub->save();
                
            }
            return parent::afterSave();
        }
        /**
         * Shows how much disk disk space is allocated to account
         * @return int MB
         */
        public function getAccountPackageDiskLimit()
        {
            $rec = Account::model()->find('id=:id',array('id'=>  Yii::app()->user->mainaccountid))->account_package->space_limit;
            return $rec;
        }
        /**
         * Number of email accounts that can be created by account
         * @return int email accounts
         */
        public function getAccountPackageEmailLimit()
        {
            $rec = Account::model()->find('id=:id',array('id'=>  Yii::app()->user->mainaccountid))->account_package->email_limit;
            return $rec;
        }
        /**
         * Number of email accounts already created by account
         * @return int mailbox count
         */
        public function getAccountEmailsCount()
        {
            $rec = EmailAccounts::model()->count('account=:ac',array('ac'=>  Yii::app()->user->mainaccountid));
            return $rec;
        }
        /**
         * Email accounts created as a percentage of email account allocation
         * @return double percentage
         */
        public function getAccountEmailsCreatePercent()
        {
            $val = $this->getAccountEmailsCount() / $this->getAccountPackageEmailLimit();
            return Yii::app()->numberFormatter->format('', $val*100);
        }
        /**
         * Disk space usage as a percentage disk space allocation
         * @return int percent
         */
        public function getAccountPackageDiskUsagePercent()
        {
            $zm = new yiiZimbra();
            $val = $zm->getDomainDiskUsage(Yii::app()->user->accountdomain) / $this->getAccountPackageDiskLimit();
            return Yii::app()->numberFormatter->format('', $val*100);
        }
        /**
         * Top disk space consuming email accounts
         * @param int $count
         * @return string json formatted array
         */
        public function getTopDiskUserData($count)
        {
            $zm = new yiiZimbra();
            $string = "['Email','Quota Used'],";
            
            $re = $zm->getTopDiskUsers(Yii::app()->user->accountdomain,$count);
            foreach($re as $rec)
            {
                $string .="['".$rec['email']."',".$rec['quotaUsed']."],";
            }
            
            return $string;
        }
}