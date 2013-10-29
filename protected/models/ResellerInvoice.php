<?php

/**
 * This is the model class for table "resellerInvoice".
 *
 * The followings are the available columns in table 'resellerInvoice':
 * @property integer $id
 * @property integer $reseller_account
 * @property double $amount
 * @property string $invoice_period_start
 * @property string $invoice_period_end
 * @property string $invoice_due_date
 * @property string $status
 *
 * The followings are the available model relations:
 * @property ResellerAccounts $resellerAccount
 * @property ResellerPayment[] $resellerPayments
 */
class ResellerInvoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResellerInvoice the static model class
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
		return 'resellerInvoice';
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
			array('id, reseller_account', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('status', 'length', 'max'=>1),
			array('invoice_period_start, invoice_period_end, invoice_due_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, reseller_account, amount, invoice_period_start, invoice_period_end, invoice_due_date, status', 'safe', 'on'=>'search'),
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
			'resellerAccount' => array(self::BELONGS_TO, 'ResellerAccounts', 'reseller_account'),
			'resellerPayments' => array(self::HAS_MANY, 'ResellerPayment', 'reseller_invoice'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'reseller_account' => 'Reseller Account',
			'amount' => 'Amount',
			'invoice_period_start' => 'Invoice Period Start',
			'invoice_period_end' => 'Invoice Period End',
			'invoice_due_date' => 'Invoice Due Date',
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
		$criteria->compare('reseller_account',$this->reseller_account);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('invoice_period_start',$this->invoice_period_start,true);
		$criteria->compare('invoice_period_end',$this->invoice_period_end,true);
		$criteria->compare('invoice_due_date',$this->invoice_due_date,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}