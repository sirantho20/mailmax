<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author tony
 */
class User {
    //put your code here
    public $user;
    
    public function __construct() 
    {
       $this->user = Users::model()->find('id=:id',array('id'=>  Yii::app()->user->id));
    }
}

?>
