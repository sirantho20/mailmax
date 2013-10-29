<?php

/**
 * This is the model class for table "interested_clients".
 *
 * The followings are the available columns in table 'interested_clients':
 * @property integer $id
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $added_date
 * @property string $hash_id
 */
class InterestedClients extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InterestedClients the static model class
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
		return 'interested_clients';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, firstname, lastname', 'length', 'max'=>45),
                        array('email, firstname, lastname','required'),
                        array('email','unique'),
			array('added_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, firstname, lastname, added_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email Address',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'added_date' => 'Added Date',
                        'hash_id'=>'hash_id',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('added_date',$this->added_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function beforeValidate() {
            $pass = new passwordGen;
            $password = $pass->passGen();
            $this->hash_id = $password;
            return parent::beforeValidate();
        }
        
}