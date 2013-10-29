<?php

class LoginController extends Controller
{
    public $layout = "//layouts/login";
	public function actionIndex()
	{
		$log = new LoginForm();
                
                if(isset($_POST['LoginForm']))
                {
                    $log->attributes = $_POST['LoginForm'];
                    //die('here');
                    if($log->login())
                    {
//                        $zm = new yiiZimbra();
//                        $zm->reverseDomainAccounts(Yii::app()->user->accountdomain);
                        $this->redirect(Yii::app()->createUrl('dashboard/index'));
                    }
                    else 
                    {
                        Yii::app()->user->setFlash('error', 'Incorrect username or password');
                    }
                }
                $this->render('index',array('model'=>$log));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}