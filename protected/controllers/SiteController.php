<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
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
     * @return array access control rules 433,443,543,535,5
     */
        public function accessRules()
        {
            return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                    'users'=>array('*'),
                )
            );
        }
        public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
//            $zm = new yiiZimbra();
//            //$zim = new zimbraAdmin();
//            $all = $zm->getAccounts('jefam-ghana.com');
//            $count = 0;
//            //print_r($all);die();
//            foreach ($all as $email)
//            {
//                if($zm->deleteAccount($email))
//                {
//                    $count++;
//                }
//            }
            if(!Yii::app()->user->isGuest)
            {
                Yii::app()->request->redirect(Yii::app()->createUrl('dashboard')); //(Yii::app()->user-createUrl('dashboard/index'));
            }
            else
            {
                $this->render('index');
            }
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */

        public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
                    //print_r($error);die();
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->renderPartial('error', array('code'=>$error['code'],'message'=>$error['message']));
		}
	}

	/**
	 * Displays the contact page
	 */
        
	public function actionContact()
	{
            $this->layout = '//layouts/clean';
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}