<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DistributionListForm
 *
 * @author tony
 */
class DistributionListForm extends CFormModel {
    //put your code here
    public $name;
    public $email;
    


    public function rules()
	{
		return array(
			array('name, email', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'Group Name',
                        'email'=>'Email Address',
		);
	}
}

?>
