<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of yiiZimbra
 *
 * @author tony
 */
class yiiZimbra extends CApplicationComponent {
    private $zim;
    private $zim2;
    public $error_msg;

    /**
 * Yii component that wraps all handy zimbra methods for easy access
 */
    public function __construct() {
        $this->zim = new zimbraAdmin();
        $this->zim2 = new ZimbraAdmin2($this->zim->server,$this->zim->zimbra_auth);
    }
    
    public function createCos($name) 
    {
        if($cosCreate = $this->zim->zimbra_create_cos("$name"))
        {
            return $cosCreate['COS']['ID'];// $this->zim->zimbra_get_id_from_cos($cosCreate['COS']['NAME']);
        }
        else
            {
                $this->error_msg = $this->zim->zimbraerror;
                return false;   
            }
    }
    /**
     * Create a new zimbra domain with optional Options parameter
     * @param String $domain A string representing domain name to be created. This domain should have been registered with a domain registrar e.g. @link www.enom.com Domain registratra
     * @param type $options Other zimbra domain options e.g. Virtual host(vhost)
     */
    public function create_domain($domain,$a)
    {
        
        $request = $this->zim->zimbra_create_domain($domain, $a);
        if($request)
        {
            return $request['DOMAIN']['ID'];
        }
        else 
        {
            $this->error_msg = $this->zim->zimbraerror;
            return FALSE;
        }
    }
    
    public function modifyAccount($name,$a)
    {
        if($request = $this->zim->zimbra_modify_account($name, $a))
        {
            return true;
        }
        else 
        {
            $this->error_msg = $this->zim->zimbraerror;
            return false;
        }
    }


    public function modifyDomain($domain,$a)
    {
        if($request = $this->zim->zimbra_modify_domain($domain, $a))
        {
            return true;
        }
        else
        {
            $this->error_msg = $this->zim->zimbraerror;
            return false;
        }
    }
    public function get_domain($domain)
    {
        
        $fields = array();
        if($request = $this->zim->zimbra_get_domain($domain))
        {
            //print_r($request);die();
            $fields['ID'] = $request['DOMAIN']['ID'];
            $fields['NAME'] = $request['DOMAIN']['NAME'];
            
            $record = $request['DOMAIN']['A'];
            $attr_count = count($record);
            //echo $attr_count;
            for($i = 0; $i <= $attr_count; $i++)
            {
                //
                if(@$record[$i]['N'] == 'zimbraMailStatus')
                {
                    $fields['zimbraMailStatus'] = $record[$i]['DATA'];
                }
                
                //
                if(@$record[$i]['N'] == 'zimbraCreateTimestamp')
                {
                    $fields['zimbraCreateTimestamp'] = Yii::app()->dateFormatter->formatDateTime($record[$i]['DATA']);
                }
                
                 //
                if(@$record[$i]['N'] == 'zimbraVirtualHostname')
                {
                    $fields['zimbraVirtualHostname'] = $record[$i]['DATA'];
                }
                
                //
                if(@$record[$i]['N'] == 'zimbraDomainDefaultCOSId')
                {
                    $fields['zimbraDomainDefaultCOSId'] = $record[$i]['DATA'];
                }
                
            }
            
            return $fields;
        }
        else
        {
            return false;
        }
        
        
        
    }
    
    public function getAccounts($domain)
        {
        
            
            if($response = $this->zim->zimbra_get_all_accounts($domain))
            {
                $result = array();
                foreach($response as $account)
                {
                    //$result = array(); // single account record
                    //$result['id'] = $account['ID'];
                    $exclude = array(
                        'galsync@'.$domain,
                        'ham@'.$domain,
                        'spam@'.$domain,
                        'admin@'.$domain,
                        'virus-quarantine@'.$domain,
                        'postmaster@'.$domain,
                    );
                    if(!in_array($account['NAME'], $exclude))
                    {
                        $result[] = $account['NAME'];
                    }
                }
                
                
               return $result;
            }
            
            
            
        }
        /**
         * Get all email accounts under the currently loged in user
         * @param type $cos Class of service of main account
         */
        public function getAllAccounts()
        {
            $return = array();
            $domains = Domain::getDomains();
            if($domains !==NULL)
            {
                
                foreach($domains as $domain)
                {
                    if($single = $this->getAccounts($domain))
                    {
                        $return = array_merge($single,$return);
                    }
                }
            }
            
            return $return;
        }
        public function createAccount($name,$password,$a=NULL)
        {
            if($this->zim->zimbra_create_account($name, $password, $a))
            {
                return true;
            }
            else 
            {
                    $this->error_msg = $this->zim->zimbraerror;
                    return false;
            }
        }
        public function suspendAccount($name)
        {
            if($re = $this->zim->zimbra_modify_account($name, array('zimbraAccountStatus'=>'locked')))
            {
                return true;
            }
            else 
            {
                $this->error_msg = $this->zim->zimbraerror;
                return false;
                
            }
        }

        public function getAccountID($name)
        {
            if($re = $this->zim->zimbra_get_id_from_account($name))
            {
                return $re;
            }
            else 
            {
                $this->error_msg = $this->zim->zimbraerror;
                die($this->error_msg);
                
                return false;
            }
        }
        public function getAccountStatus($name)
        { 
            if($re=$this->zim->zimbra_get_account($name))
            {
                //return $re;
                foreach ($re['A'] as $attr)
                {
                    if($attr['N'] == 'zimbraAccountStatus')
                    {
                        return $attr['DATA'];
                    }
                }
                
            }
            else 
            {
                return false;
            }
        }
        public function getAccountLastLoginDate($name)
        {
            if($account = $this->zim->zimbra_get_account($name))
            {
                
                    foreach($account['A'] as $attr)
                    {
                        //
                        if($attr['N'] =='zimbraLastLogonTimestamp')
                        {
                            return $attr['DATA'];
                        }
                    }
            }
            else 
            {
                return false;
            }
        }
        /*
         * Get zimbra LDAP details of email account
         * @params string Email 
         */
        public function getAccount($name)
        {
            if($account = $this->zim->zimbra_get_account($name))
            {
                    $result = array(); // single account record
                    $result['id'] = $account['ID'];
                    $result['email'] = $account['NAME'];
                    foreach($account['A'] as $attr)
                    {
                        //
                        if($attr['N'] =='sn')
                        {
                            $result['sn'] = $attr['DATA'];
                        }
                        
                        //
                        if($attr['N'] =='givenName')
                        {
                            $result['givenName'] = $attr['DATA'];
                        }
                        //
                        if($attr['N'] =='zimbraLastLogonTimestamp')
                        {
                            $result['zimbraLastLogonTimestamp'] = $attr['DATA'];
                        }
                        
                        //
                        if($attr['N'] =='zimbraMailQuota')
                        {
                            $result['zimbraMailQuota'] = @$attr['DATA'];
                        } 
                        
                        //
                        if($attr['N'] =='zimbraCreateTimestamp')
                        {
                            $result['zimbraCreateTimestamp'] = $attr['DATA'];
                        }
                        
                        //
                        if($attr['N'] =='zimbraAccountStatus')
                        {
                            $result['zimbraAccountStatus'] = $attr['DATA'];
                        }
                        
                        //
                        if($attr['N'] =='zimbraCOSId')
                        {
                            $result['zimbraCOSId'] = $attr['DATA'];
                        }
                        
                        //
                        if($attr['N'] =='zimbraLastLogonTimestamp')
                        {
                            $result['zimbraLastLogonTimestamp'] = $attr['DATA'];
                        }
                        
                        
                    }
                    
                    return $result;
            }
            else 
            {
                $this->error_msg = $this->zim->zimbraerror;
                return false;
            }
        }
        
        public function deleteAccount($name)
        {
            if($del = $this->zim->zimbra_delete_account($name))
            {
                return $del;
            }
            else 
            {
                $this->error_msg = $this->zim->zimbraerror;
                return false;
            }
        }
        public function lockDomain($name)
        {
            if($ac=$this->zim->zimbra_lock_domain($name))
            {
                return true;
            }
            else 
            {
                $this->error_msg = $this->zim->zimbraerror;
                return false;
            }
        }
        
        public function unlockDomain($name)
        {
            if($ac=$this->zim->zimbra_unlock_domain($name))
            {
                return true;
            }
            else 
            {
                $this->error_msg = $this->zim->zimbraerror;
                return false;
            }
        }
        public function toggleDomain($name,$status)
        {
            if($status =='a')
            {
                return $this->unlockDomain($name);
            }
            elseif($status=='s') 
            {
                return $this->lockDomain($name);
            }
        }
        public function resetAccountPassword($name,$pass)
        {
//            $a = array('userPassword'=>$pass);
//            $call = $this->zim->zimbra_modify_account($name, $a);
//            return $call;
                $this->zim->zimbra_set_account_password($name, $pass);
                if($this->zim->zimbra_modify_account($name, array('zimbraPasswordMustChange'=>'TRUE')))
                {
                    return true;
                }
                else 
                {
                    $this->error_msg = $this->zim->zimbraerror;
                    return false;
                }
                return true;
            
        }
        public function passwordStrengh($name,$pass)
        {
            
        }
        public function getAccountQuota($name)
        {
            if($re = $this->zim2->getQuotas(array('name'=>'')))
            {
               foreach($re as $key=>$details)
               {
                   if($details['name']==$name)
                   {
                       return $details['limit'] / Yii::app()->params['zmQuotaFactor'];
                       break;
                   }
               }
                    
                    //return $result;
            }
            else 
            {
                $this->error_msg = $this->zim->zimbraerror;
                return false;
            }
        }
        public function getAccountQuotaUsage($name)
        {
            if($re = $this->zim2->getQuotas(array('name'=>'')))
            {
               foreach($re as $key=>$details)
               {
                   if($details['name']==$name)
                   {
                       return $details['used'] / Yii::app()->params['zmQuotaFactor'];
                       break;
                   }
               }
                    
                    //return $result;
            }
            else 
            {
                $this->error_msg = $this->zim->zimbraerror;
                return false;
            }
        }
        public function getDomainDiskUsage($domain)
        {
            if($re=$this->zim2->getTotalQuota($domain))
            {
                return $re['diskUsage'] / Yii::app()->params['zmQuotaFactor'];
            }
            else 
            {
                return $re;
            }
        }
        public function getDomainDiskProvisioned($domain)
        {
            if($re=$this->zim2->getTotalQuota($domain))
            {
                return $re['diskProvisioned'] / Yii::app()->params['zmQuotaFactor'];
            }
            else 
            {
                return $re;
            }
        }
        
        public function getDomainDiskUsagePercent($domain)
        {
            return Yii::app()->numberFormatter->formatPercentage($this->getDomainDiskUsage($domain) / $this->getDomainDiskProvisioned($domain));
        }
        public function getAccountQuotaUsagePercentage($name)
        {
            if($this->getAccountQuota($name)<1)
            {
                return 0;
            }
            return Yii::app()->numberFormatter->formatPercentage($this->getAccountQuotaUsage($name)/$this->getAccountQuota($name));
        }
        public function reverseDomainAccounts($domain)
        {
            
            $users = $this->getAccounts($domain);
                 
            $importsCount = 0;
            foreach($users as $user)
            {
               
                
                $details = $this->getAccount($user);
                $email = $details['email'];
                
                if(!EmailAccounts::model()->exists('email=:mail',array('mail'=>$email)))
                {
                    //array_push($local, $email);
                    //echo $details['zimbraMailQuota'];die();
                    $model = new EmailAccounts();        
                    $model->first_name = $details['givenName'];
                    $model->last_name = $details['sn'];
                    $model->email = $details['email'];
                    $model->quota = $details['zimbraMailQuota'] / Yii::app()->params['zmQuotaFactor'];
                    $model->status = $details['zimbraAccountStatus'];
                    $model->id = $details['id'];
                    $model->save();
                    $importsCount++;
                    
                }
            }
            return $importsCount;
        }
        /*
         * Get top highest disk space using email accounts. Sorted in descending order according to disk used.
         * @param string $domain Name of domain which email accounts belong
         * @param integer $count Number of email accounts to return
         */
        public function getTopDiskUsers($domain,$count=5)
        {
            //die($domain);
            $accounts = $this->getAccounts($domain);
            if(empty($accounts))
            {
                $accounts = array('noAccount@your.domain');
            }
            $result = array();
            
            foreach($accounts as $email)
            {
                $result["$email"] = Yii::app()->numberFormatter->format('', $this->getAccountQuotaUsage($email));
            }
            
            arsort($result,SORT_NUMERIC);
            $result2 = array_slice($result, 0, $count, true);
            $out = array();
            
            foreach($result2 as $key=>$value)
            {
                $ml = explode('@', $key);
                $out[] = array('email'=>$ml[0], 'quotaUsed'=>$value);
            }
            $arrData = new CArrayDataProvider($out);
            return $out;
        }
        /* 
         * Get all distribution lists under a domain
         * @params string $domain
         * @return array id => name pair of distribution lists
         */
        public function getDomainDistributionLists($domain)
        {
            $rec = $this->zim2->getDistributionLists($domain);
            //print_r($rec);die();
            $result = array();
            foreach($rec as  $obj)
            {
                $result[$obj->id] = $obj->cn;
            }
            
            return $result;
        }
        /*
         * Get ID of a single distribution list from a Domain
         * @params $name Name of distribution list
         * @params $domain Name of domain where distributionlist belongs
         * return string $id Id of distribution list
         */
        public function getDistributionListId($name,$domain)
        {
            $rec = $this->zim2->getDistributionLists($domain);
            foreach($rec as  $obj)
            {
                if($obj->name ==$name)
                {
                    return $obj->id;
                    break;
                }
            }
        }
        public function createDistributionList($options)
        {
            if($rec = $this->zim2->createDistributionList($options))
            {
                return $rec->id;
            }
            else
            {
                $this->error_msg = $this->zim2->err_msg;
                return false;
            }
        }
        
        public function modifyDistributionList($values)
        {
            if($this->zim2->modifyDistributionList($values))
            {
                return true;
            }
            else 
            {
                $this->error_msg = $this->zim2->err_msg;
                return false;
            }
        }
        public function deleteDistributionList($id)
        {
            if($rec=$this->zim2->deleteDistributionList($id))
            {
                return TRUE;
            }
            else 
            {
                $this->error_msg = $this->zim2->err_msg;
                return FALSE;
            }
        }

        public function addDistributionListMember($id,$member)
        {
            //$member2 = str_replace('_', '.', $member);
            if($this->zim2->addDistributionListMember($id, $member))
            {
                return true;
            }
            else 
            {
                die($this->zim2->err_msg);
            }
        }
        public function removeDistributionListMember($id,$member)
        {
            if($this->zim2->removeDistributionListMember($id, $member))
            {
                return true;
            }
            else 
            {
                $this->error_msg = $this->zim2->err_msg;
                return false;
            }
        }
        /*
         * Get all members of a distribution list or group
         * @param string $list ID of the list
         */
        public function getDistributionListMembers($list)
        {
            //$id = $this->getDistributionListId($list, Yii::app()->user->accountdomain);
            $id = $list;
            $rec = $this->zim2->getDistributionList($id);
            $members = $rec->members;
            
            $url = urlencode($members);
            
            $ar = str_replace('%40', '@', $url);
            $arr = explode('%0D%0A', $ar);
            return $arr;
        }
        public function getDistributionList($id)
        {
            if($rec = $this->zim2->getDistributionList($id))
            {
                //print_r($rec);die();
                isset($rec->displayName)?$dn = $rec->displayName:$dn=$rec->cn;
                return array('email'=>$rec->name,'name'=>$dn);
            }
            else 
            {
                $this->error_msg = $this->zim2->err_msg;
                return false;
            }
        }
        
        public function newAccount($dom)
        {
            if($domain = $this->zim->zimbra_create_domain($dom))
            {
                if($cos = $this->createCos($dom))
                {
                    return $cos;
                } 
                else
                {
                    $this->zim->zimbra_delete_domain($domain);
                    $this->error_msg = $this->zim->zimbraerror;
                    return false;
                }
            }
            else 
            {
                $this->error_msg = $this->zim->zimbraerror;
                return false;
            }
        }
                
        
        
}

?>
