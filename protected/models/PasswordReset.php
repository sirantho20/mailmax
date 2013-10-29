<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasswordReset
 *
 * @author tony
 */
class PasswordReset extends CFormModel
{
    //put your code here
    public $password;
    public $verify;
    
    public function rules() {
        return array(
            array('verify','compare','compareAttribute'=>'password'),
            array('password,verify','required'),
        );
    }
    
    public function attributeLabels() 
    {
        return array(
            'password'=>'New Password',
            'verify'=>'Repeat Password',
            );
    }
}

?>
