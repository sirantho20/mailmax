<?php

class EmailAccountsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/sidebar';
        public $sidebar;

	/**
	 * @return array action filters
	 */
                public function init()
        {
            $side = new sideBar();
            $side->addList('New Email Account', $this->createUrl('create'), 'createnewemailaccount')
                 ->addList('Manage Accounts', $this->createUrl('admin'), 'manageemailaccounts');
            $this->sidebar = $side->getSideBar();
            
            
            
        
        }
	public function filters()
	{
		return array(
                'accessControl', // perform access control for CRUD operations
                array(
                        'application.filters.YXssFilter',
                        'clean'   => '*',
                        'tags'    => 'strict',
                        'actions' => 'all'
                ),
            );
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'users'=>array('@'),
                ),
                array('deny',  // deny all usersl
                    'users'=>array('*'),
                ),
            );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            $model = $this->loadModel($id);
            $zm = new yiiZimbra();
            $q = $zm->getAccountQuota($model->email.'@'.Yii::app()->user->accountdomain);
            $used = $zm->getAccountQuotaUsagePercentage($model->email.'@'.Yii::app()->user->accountdomain);
		$this->render('view',array(
			'model'=>$model,
                        'quotaused'=>$used,'quota'=>$q,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                $ac = new Account();
                if($ac->getAccountEmailsCount() < $ac->getAccountPackageEmailLimit())
                {
                }
                else 
                {
                    Yii::app()->user->setFlash('error','Sorry, you have reached your email accounts limit. You need to upgrade your account to be able to create new email accounts.'.CHtml::link('Upgrade now', '#')); 
                    $this->redirect($this->createUrl('admin'));
                }
		
                $model=new EmailAccounts('create');
                //die(Yii::app()->user->mainaccountid());
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EmailAccounts']))
		{
			$model->attributes=$_POST['EmailAccounts'];
			$zm = new yiiZimbra();
                        $a = array();
                        $a['sn'] = $model->last_name;
                        $a['givenName'] = $model->first_name;
                        $a['title'] = $model->job_title;
                        $a['zimbraMailQuota'] = $model->quota * Yii::app()->params['zmQuotaFactor'];
                        $a['ou'] = $model->department;
                        $a['displayName'] = $model->first_name.' '.$model->last_name;
                        $a['zimbraPasswordMustChange'] = 'TRUE';
                        
                        $name = $model->email.'@'.Yii::app()->user->accountdomain;
                        $model->email = $name;
                        
			if($model->validate())
                        {
                            if($zm->createAccount($name, $model->password,$a))
                            {
                                $model->id = $zm->getAccountID($name);
                                $model->save();
                                Yii::app()->user->setFlash('success','Email successfully created');
                                $this->redirect($this->createUrl('admin'));
                            } 
                            else
                            {
                                Yii::app()->user->setFlash('error',"Sorry, something didn't go right. [$zm->error_msg]");
                            }
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EmailAccounts']))
		{
			$model->attributes=$_POST['EmailAccounts'];
                        $zm = new yiiZimbra();
                        $a = array();
                        $a['sn'] = $model->last_name;
                        $a['givenName'] = $model->first_name;
                        $a['title'] = $model->job_title;
                        $a['zimbraMailQuota'] = $model->quota * Yii::app()->params['zmQuotaFactor'];
                        $a['ou'] = $model->department;
                        $a['displayName'] = $model->first_name.' '.$model->last_name;
                        $a['zimbraPasswordMustChange'] = 'TRUE';
                        $a['zimbraAccountStatus'] = $_POST['EmailAccounts']['status'];
                        //die($_POST['EmailAccounts']['status']);
                        $name = $model->email.'@'.Yii::app()->user->accountdomain;
                        //die($name);
                        //$a['email'] = $name;
                        $model->email = $name;
                        $model->status = $_POST['EmailAccounts']['status'];
                        
			if($model->validate())
                        {
                            if($zm->modifyAccount($name,$a))
                            {
                                //die('modified');
                                //$model->id = $zm->getAccountID($name);
                                $model->save();
                                //die($model->status);
                                Yii::app()->user->setFlash('success','Email successfully updated');
                                $this->redirect($this->createUrl('admin'));
                            } 
                            else
                            {
                                die($zm->error_msg);
                                Yii::app()->user->setFlash('error',"Sorry, something didn't go right. [$zm->error_msg]");
                            }
                        }
                        else 
                        {
                            //die('validation error');
                        }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $zm = new yiiZimbra();
            //die($id);
            if($zm->deleteAccount($id))
            {
                
              if(EmailAccounts::model()->deleteAll('email=:email',array('email'=>$id)) >0)
              {
                  Yii::app()->user->setFlash('success','Email account successfully deleted.');
                                   
                  
              }
              else 
              {
                  //print_r($mod->getErrors());die();
                  Yii::app()->user->setFlash('error','Error deleting email account from local database ');
              }
              
                $this->redirect($this->createUrl('admin'));
            }   
            else 
            {
                Yii::app()->user->setFlash('error','Error deleting email account '.$zm->error_msg);
                $this->redirect($this->createUrl('admin'));
            }
//		$this->loadModel($id)->delete();
//
//		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//		if(!isset($_GET['ajax']))
//			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
//            $emails = EmailAccounts::model()->find('email =:mail',array('mail'=>'subaye@bullion.com.gh'));
//            die($emails->mail);
//            foreach($emails->email as $mail)
//            {
//                echo $mail.'<br />';
//            }
//            die();
            $zm = new yiiZimbra();
            //print_r($zm->getAccount('kofi.agyei@bullion.com.gh'));
            //$zm->reverseDomainAccounts('marketresearch.com.gh');
            //print_r($zm->getAccount('subaye@bullion.com.gh'));
            $this->redirect($this->createUrl('admin'));
//		$dataProvider=new CActiveDataProvider('EmailAccounts');
//		$this->render('admin',array(
//			'dataProvider'=>$dataProvider,
//		));
	}

	/**
	 * Manages all models.
	 */
        public function suspendEmailAccount($name)
        {
            $zm = new yiiZimbra();
            if($zm->suspendAccount($name))
            {
                $user = EmailAccounts::model()->find('email=:mail',array('mail'=>$name));
                $user->status='locked';
                $user->save();
            }
        }
	public function actionAdmin()
	{
                dns_get_mx(Yii::app()->user->accountdomain, $hosts);
               
                    if(array_search("mail2.i-webb.net", $hosts)==FALSE)
                    {
                        Yii::app()->user->setFlash('global','Notice! MX record for '.Yii::app()->user->accountdomain.' is not pointed to our mail server(mail2.i-webb.net). Please make necessary changes in your DNS records before your emails can work.');
                    }
                
                
                $ac = new Account();
                $zm = new yiiZimbra();
                if($ac->getAccountEmailsCount() < count($zm->getAccounts(Yii::app()->user->accountdomain)))
                {
                    
                    $zm->reverseDomainAccounts(Yii::app()->user->accountdomain);
                }
		$model=new EmailAccounts('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmailAccounts']))
			$model->attributes=$_GET['EmailAccounts'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        public function actionresetAccountPassword($account)
        {
            
            $email = $account.'@'.Yii::app()->user->accountdomain;
            $pw = new passwordGen();$password = $pw->passGen();
            
            $zm = new yiiZimbra();
            if($zm->resetAccountPassword($email, $password))
            {
                die('<span class="alert">New password is: <b>'.$password.'</b></span>');
            }
            else 
            {
                die($zm->error_msg);
            }
            
        }

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EmailAccounts the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EmailAccounts::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EmailAccounts $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='email-accounts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function renderStatus($data,$row)
        {
            $ou = '';
            
            if($data->status =='active')
            {
                $ou = '<span class="label label-success">active</span>';
            }
            elseif($data->status=='locked')
            {
                $ou = '<span class="label label-warning">locked</span>';
            }
            elseif($data->status=='closed')
            {
                $ou = '<span class="label label-important">closed</span>';
            }
            else
            {
                $ou = '<span class="label label-info">unknown</span>';
            }
            
            return $ou;
        }
        public function renderQuota($data,$row)
        {
            return '<div class="progress"><div class="bar" style="width: 60%;">'.$data->quota.'</div></div>';
        }
        public function renderLastLogon($data,$row)
        {
            if($data->lastlogon=='')
            {
                return 'never loged in';
            }
            else 
            {
                return Yii::app()->dateFormatter->formatDateTime($data->lastlogon,"medium");
            }
        }
}
