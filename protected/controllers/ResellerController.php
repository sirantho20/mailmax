<?php

class ResellerController extends Controller
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
            $side->addList('Manage Accounts', $this->createUrl('admin'), 'manageclientaccount')
                 ->addList('Packages', $this->createUrl('package/admin'), 'manageResellerPackages');
            $this->sidebar = $side->getSideBar();
        }
        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				//'actions'=>array('admin','delete'),
				'users'=>array('@'),
                                'expression'=>  'Yii::app()->user->IsReseller',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
        public function actionIndex()
        {
            $zm = new yiiZimbra();
               //echo($zm->getAccountQuota('geert@bullion.com.gh') / Yii::app()->params['zmQuotaFactor']);
           // echo $zm->getAccount('kofi.agyei@bullion.com.gh');
            //print_r($zm->getAccount('kofi.agyei@bullion.com.gh'));
            //echo $zm->getAccountQuotaUsagePercentage('kofi.agyei@bullion.com.gh');
        }
        public function actionView($id)
	{
            //$users = Users::model()->findAllByAttributes(array('account'=>$id));
            //print_r($users);die();
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Account;
                //$user=new Users();
                //die('inside');
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
                    //die('posted');
			$model->attributes=$_POST['Account'];
                        //die('attr set');
                        //$user->attributes=$_POST['Users'];
                        $zm = new yiiZimbra();
                        if($model->validate())
                        {
                            //die('validated');
                            if($cos = $zm->createCos($model->domain))
                            {
                                $a = array();
                                $a['zimbraVirtualHostname'] = $model->vhost;
                                $a['zimbraDomainDefaultCOSId'] = $cos;

                                if($zm->create_domain($model->domain, $a))
                                {
                                    $model->cos = $cos;
                                    $model->save();
                                    Yii::app()->user->setFlash('success','Account '.$model->business_name.' successfully created');
                                    $this->redirect(array('admin','id'=>$model->id));

                                }
                                else 
                                {
                                    Yii::app()->user->setFlash('error','Error creating domain '.$zm->error_msg);
                                }
                            }
                            else 
                            {
                                Yii::app()->user->setFlash('error','Error creating cos '.$zm->error_msg);
                            }
                        }
			
		}

		$this->render('create',array(
			'model'=>$model
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
                //$user= Users::model()->find('account=:id',array('id'=>$id));
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Account']))
		{
			$model->attributes=$_POST['Account'];
                        //$model->attributes=$_POST['Users'];
			if($model->save())
                        {
                            
                            Yii::app()->user->setFlash('success','Account information successfully updated');
                                //$this->redirect(array('view','id'=>$model->id));
                            
				
                        }
		}

		$this->render('update',array(
			'model'=>$model
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
        
        public function actionUserCreate()
        {
            $model=new Users('Createnew');
            $ac = $_GET['ac'];
            //die($ac);
            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);
            if(isset($_POST['Users']))
            {
                $model->attributes=$_POST['Users'];
                $model->account = $ac;
                if($model->save())
                    $this->redirect(array('view','id'=>$ac));
            }

            $this->render('_user',array('ac'=>$ac,
                'model'=>$model,
            ));
        }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUserUpdate($id)
    {
        //$model=$this->loadModel($id);
        $model = Users::model()->find('id=:id',array('id'=>$id));
        $model->scenario = 'userupdate';
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Users']))
        {
            $model->attributes=$_POST['Users'];
            if($model->save())
            {
                Yii::app()->user->setFlash('success','Updates successfully saved.');
                //$this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('_user',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionUserDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            //$this->loadModel($id)->delete();
            Users::model()->find('id=:id',array('id'=>$id))->delete();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Account('search');
                //print_r($model);die();
                //print_r($model->search()->getCriteria());die();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Account']))
			$model->attributes=$_GET['Account'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionSuspend($id)
        {
            $model = Account::model()->find('id=:id',array('id'=>$id));
            $model->status =='a'?$model->status = 's':$model->status = 'a';
            $zm = new yiiZimbra();
            if($zm->toggleDomain($model->domain, $model->status))
            {
                if($model->save())
                {
                    Yii::app()->user->setFlash('success','Account <span style="color:red;">'.$model->business_name.'</span> successfully updated');
                    $this->redirect(array('admin'));
                } 
            }
            else 
            {
                Yii::app()->user->setFlash('error','Error changing account status. '.$zm->error_msg);
                $this->redirect(array('admin'));
            }
        }
        
        public function actionresetAccountPassword($id)
        {
            $model = new Users();
            if($model->resendPassword($id))
            {
                die('<span class="success">Password sent to user</span>');
            }
            else 
            {
                die('<span class="error">Error sending password</span>');
            }
            
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Account the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Account::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Account $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
