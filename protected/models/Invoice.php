<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property integer $id
 * @property integer $account
 * @property integer $duration_months
 * @property string $status
 * @property string $Amount
 * @property string $invoiceDate
 * @property string $dueDate
 * @property string $overDue
 *
 * The followings are the available model relations:
 * @property Account $account0
 * @property Payment[] $payments
 */
class Invoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
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
		return 'invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('account, duration_months', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>1),
			array('Amount', 'length', 'max'=>45),
			array('invoiceDate, dueDate, overDue', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, account, duration_months, status, Amount, invoiceDate, dueDate, overDue', 'safe', 'on'=>'search'),
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
			'payments' => array(self::HAS_MANY, 'Payment', 'invoice'),
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
			'duration_months' => 'Duration Months',
			'status' => 'Status',
			'Amount' => 'Amount',
			'invoiceDate' => 'Invoice Date',
			'dueDate' => 'Due Date',
			'overDue' => 'Over Due',
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
		$criteria->compare('duration_months',$this->duration_months);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('Amount',$this->Amount,true);
		$criteria->compare('invoiceDate',$this->invoiceDate,true);
		$criteria->compare('dueDate',$this->dueDate,true);
		$criteria->compare('overDue',$this->overDue,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}