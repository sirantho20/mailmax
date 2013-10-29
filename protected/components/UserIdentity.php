<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $id;
    private $cos;
    private $firstName;
    private $lastName;
    private $email;

    /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
            $login = Users::model()->find('username = :user',array('user'=>$this->username));
            //die($this->password);
		if($login===NULL)
                {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
                }
		else if(trim($login->pword) != trim(md5($this->password)))
                {
                        //die(md5($this->password).' - here');
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
                }
		else
                {
                  
                    $this->id = $login->id;
                    $cos = $login->mainaccount->cos;
                    $this->setState('cos', $cos);
                    $this->setState('firstname', $login->firstName);
                    $this->setState('lastname', $login->lastName);
                    $this->setState('id', $login->id);
//                    $this->setState('account_id', $login->mainaccount->id);
//                    $this->setState('businessName', $login->mainaccount->business_name);
//                    $this->setState('account_package',$login->mainaccount->package);
//                    $this->setState('account_status', $login->mainaccount->status);
//                    $this->setState('account_email', $login->mainaccount->email);
//                    $this->setState('user_email', $login->email);
//                    $this->setState('user_mobile', $login->mobile);
                    
                    $this->errorCode=self::ERROR_NONE;
                }
                    return !$this->errorCode;
                
	}

        public function getLastname()
        {
            return $this->lastName;
        }

        public function getFirstname()
        {
            return $this->firstName;
        }

        public function getId()
        {
            return $this->id;
        }
        public function getCos()
        {
            return $this->cos;
        }
}