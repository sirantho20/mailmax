<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $firstName
 * @property string $pword
 * @property string $created
 * @property string $email
 * @property string $lastName
 * @property integer $mobile
 * @property integer $account
 * @property string $superAdmin
 * @property string $is_reseller
 *
 * The followings are the available model relations:
 * @property Account $account0
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, firstName, created, lastName,email', 'required'),
                        array('pword,account','required','on'=>'Createnew'),
                        array('email','email'),
			array('mobile, account', 'numerical', 'integerOnly'=>true),
			array('username, firstName, email, lastName', 'length', 'max'=>45),
			array('pword', 'length', 'max'=>50),
			array('superAdmin, is_reseller', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, firstName, pword, created, email, lastName, mobile, account, superAdmin, is_reseller', 'safe', 'on'=>'search'),
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
			'mainaccount' => array(self::BELONGS_TO, 'Account', 'account'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'firstName' => 'First Name',
			'pword' => 'Password',
			'created' => 'Created',
			'email' => 'Email',
			'lastName' => 'Last Name',
			'mobile' => 'Mobile',
			'account' => 'Account',
			'superAdmin' => 'Super Admin',
			'is_reseller' => 'Is Reseller',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('pword',$this->pword,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('account',$this->account);
		$criteria->compare('superAdmin',$this->superAdmin,true);
		$criteria->compare('is_reseller',$this->is_reseller,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeValidate() {
            //$this->account = Yii::app()->user->mainaccountid();
            $this->created = new CDbExpression('now()');
            
            return parent::beforeValidate();
        }
        public function generatePassword($user)
        {
            $passObj = new passwordGen();
            return $passObj->passGen();
            
            
        }
        public function resendPassword($user)
        {
            $model = Users::model()->find('id=:id',array('id'=>$user));
            $pass = $this->generatePassword($user);
            
            $msg = new YiiMailMessage();
            $msg->addTo('sirantho20@gmail.com');
            $msg->from = Yii::app()->params['emailFrom'];
            $msg->setSubject(CHtml::encode(Yii::app()->name.' new password generated'));
            $msg->view = 'accountMainPassword';
            $msg->setBody(array('password'=>$pass,'model'=>$model), 'text/html');
            
            $mail = new YiiMail();
            
            
            try 
            { 
                Yii::app()->mail->send($msg);
                $model->pword = md5($pass);
                $model->save();
                return true;
            }
                            catch (Swift_SwiftException $e) {die($e);} 
                            catch (Swift_TransportException  $e) {die($e);}
                            catch (Swift_RfcComplianceException  $e) {die($e);}
                            catch (Exception $e) {die($e);}
        }
}