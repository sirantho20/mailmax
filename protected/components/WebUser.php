<?php
/**
 * Description of WebUser
 *
 * @author b.adjornor
 */
class WebUser extends CWebUser
{
     //public $useremail;
     public function accountMobile()
        {
            return Users::model()->find('id=:id',array('id'=>Yii::app()->user->id))->mainaccount->mobile;
        }
        public function getaccountMobile()
        {
            return $this->accountMobile();
        }

        public function getUserEmail()
        {
            return $this->userEmail();//'tony';//$this->getState('user_email');
        }
        public function userEmail()
        {
            return Users::model()->find('id=:id',array('id'=>  Yii::app()->user->id))->email;
        }
        
        public function getAccountEmail()
        {
            return $this->accountEmail();
        }
        public function accountEmail()
        {
            return Users::model()->find('id=:id',array('id'=>Yii::app()->user->id))->mainaccount->email;
        }
        
        public function getisAccountActive()
        {
            return $this->isAccountActive();
        }
        public function isAccountActive()
        {
            return Users::model()->find('id=:id',array('id'=>Yii::app()->user->id))->mainaccount->status =='a'? true:false;
        }

        public function getAccountPackage()
        {
            return $this->accountPackage();
        }
        public function accountPackage()
        {
            return Users::model()->find('id=:id',array('id'=>Yii::app()->user->id))->mainaccount->package;
        }
        public function getBusinessname()
        {
            return $this->businessName();
        }
        public function businessName()
        {
            return Users::model()->find('id=:id',array('id'=>Yii::app()->user->id))->mainaccount->business_name;
        }
        public function userMobile()
        {
            return Users::model()->find('id=:id',array('id'=>Yii::app()->user->id))->mobile;
        }
        public function getuserMobile()
        {
            return $this->userMobile();
        }
        public function getFirstname()
        {
            return $this->firstName();
        }
        public function firstName()
        {
            return Users::model()->find('id=:id',array('id'=>Yii::app()->user->id))->firstName;
        }
        public function getMainAccountId()
        {
            return $this->mainaccountid();
        }
        public function mainaccountid()
        {
            return Users::model()->find('id=:id',array('id'=>Yii::app()->user->id))->mainaccount->id;
        }
        public function getIsReseller()
        {
            return $this->IsReseller();
        }
        public function IsReseller()
        {
            return Users::model()->find('id=:id',array('id'=>$this->id))->is_reseller =='y'?true:false;
            
        }
        public function getResellerAccountId()
        {
            return $this->ResellerAccountId();
        }
        public function ResellerAccountId()
        {
            return Users::model()->find('id=:id',array('id'=>Yii::app()->user->id))->mainaccount->resellerAccount;
        }
        public function getAccountDomain()
        {
            return $this->accountdomain();
        }
        public function accountdomain()
        {
            return Users::model()->find('id=:id',array('id'=>Yii::app()->user->id))->mainaccount->domain;
        }
        
        
}
