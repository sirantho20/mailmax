<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorController
 *
 * @author tony
 */
class ErrorController extends Controller {
    //put your code here
    public $layout='//layouts/error';
    public function actionIndex()
    {
        if($error=Yii::app()->errorHandler->error)
		{
                    //print_r($error);die();
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('index', array('code'=>$error['code'],'message'=>$error['message']));
		}
    }
}

?>
