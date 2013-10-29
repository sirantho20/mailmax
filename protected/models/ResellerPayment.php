<?php

/**
 * This is the model class for table "reseller_payment".
 *
 * The followings are the available columns in table 'reseller_payment':
 * @property integer $id
 * @property integer $reseller_invoice
 * @property string $payment_date
 * @property double $amount_paid
 * @property string $payment_method
 *
 * The followings are the available model relations:
 * @property ResellerInvoice $resellerInvoice
 */
class ResellerPayment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ResellerPayment the static model class
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
		return 'reseller_payment';
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
			array('id, reseller_invoice', 'numerical', 'integerOnly'=>true),
			array('amount_paid', 'numerical'),
			array('payment_method', 'length', 'max'=>45),
			array('payment_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, reseller_invoice, payment_date, amount_paid, payment_method', 'safe', 'on'=>'search'),
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
			'resellerInvoice' => array(self::BELONGS_TO, 'ResellerInvoice', 'reseller_invoice'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'reseller_invoice' => 'Reseller Invoice',
			'payment_date' => 'Payment Date',
			'amount_paid' => 'Amount Paid',
			'payment_method' => 'Payment Method',
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
		$criteria->compare('reseller_invoice',$this->reseller_invoice);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('amount_paid',$this->amount_paid);
		$criteria->compare('payment_method',$this->payment_method,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}