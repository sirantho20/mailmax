<?php

class SignupController extends Controller
{
    public $layout='//layouts/signup';
        
        public function init() {
            Yii::app()->user->isGuest?:Yii::app()->request->redirect(Yii::app()->createUrl('dashboard'));
            parent::init();
        }
	public function actionIndex($ch,$hid)
	{
                
                $record = InterestedClients::model()->find('email=:email and hash_id = :hid',array('email'=>$ch,'hid'=>$hid));
                if(!isset($record->email))
                {
                    throw new CHttpException(500,'Invalid access');
                }
                
                
                $bus = new Account();
                $zm = new yiiZimbra();
                $bus->scenario = 'registerwcaptcha';
                if(isset($_POST['ajax']) && $_POST['ajax']==='account-form')
		{
			echo CActiveForm::validate($bus);
			Yii::app()->end();
		}
                //die('hi');
                if(isset($_POST['Account']))
                    {
                        $bus->attributes = $_POST['Account'];
                        $bus->resellerAccount = 1;
                        $bus->signup_date = new CDbExpression('date(now())');
                        $bus->email = $record->email;
                        
                        if($bus->validate())
                        {
                        if($cos=$zm->newAccount($bus->domain))
                        {
                            $bus->cos = $cos;
                            if($bus->validate())
                            {
                                $bus->scenario = NULL;
                                
                                if($bus->save())
                                {
                                    $pass = new passwordGen();
                                    $password = $pass->passGen();

                                    //create account user
                                    $user = new Users();
                                    $user->username = $record->email;
                                    $user->firstName = $record->firstname;
                                    $user->lastName = $record->lastname;
                                    $user->email = $record->email;
                                    $user->account = $bus->getPrimaryKey();
                                    $user->created = new CDbExpression('now()');
                                    $user->is_reseller = 'n';
                                    $user->pword = md5($password);
                                    if($user->save())
                                    {
                                        //die('user created');
                                        // send confirmation email
                                        $msg = new YiiMailMessage();
                                        $msg->addTo($record->email);
                                        $msg->from = Yii::app()->params['emailFrom'];
                                        $msg->setSubject(CHtml::encode('Your new '.Yii::app()->name.' account details'));
                                        $msg->view = 'signupCompleted';
                                        $msg->setBody(array('model'=>$record,'password'=>$password), 'text/html');


                                        try 
                                        { 
                                            Yii::app()->mail->send($msg);
                                            //return true;
                                        }
                                        catch (Swift_SwiftException $e) {die($e);} 
                                        catch (Swift_TransportException  $e) {die($e);}
                                        catch (Swift_RfcComplianceException  $e) {die($e);}
                                        catch (Exception $e) {die($e);}
                                        
                                        $this->redirect($this->createUrl('success',array('hid'=>$record->hash_id)));
                                    }


                                }


                              }
                            
                        }
                        else
                        {
                            Yii::app()->user->setFlash('error','Sorry, there was an error processing your request. '.$zm->error_msg);
                        }
                        }
                                
                                
                    }


                
                
		$this->render('index',array('model'=>$bus));
//                $zim = new zimbraAdmin();
//                if(!$re = $zim->zimbra_get_cos('jefam', 'jefamghana'))
//                {
//                    die($zim->zimbraerror);
//                }
//                else
//                {
//                    var_dump($re['COS']['ID']);
//                }
                
	}
        public function actionSuccess($hid)
        {
            if(InterestedClients::model()->exists('hash_id=:hid',array('hid'=>$hid)))
            {
                $this->render('signupSuccess');
            }
            else 
            {
                throw new CHttpException(500,'Sorry, we cannot find what you are looking for.');
            }
        }

        public function actionInterest()
        {
            //parent::viewPath  'protected/views/Interested/index';
            $model = new InterestedClients();
            
            $this->performAjaxValidation($model);
            
            if(isset($_POST['InterestedClients']))
            {
                $model->attributes=$_POST['InterestedClients'];
                $model->added_date = new CDbExpression('now()');
                if($model->validate())
                {
                    if($model->save(false))
                    {
                        $msg = new YiiMailMessage();
                        $msg->addTo($model->email);
                        $msg->from = Yii::app()->params['emailFrom'];
                        $msg->setSubject('Welcome to '.CHtml::encode(Yii::app()->name));
                        $msg->view = 'emailSignupInterest';
                        $msg->setBody(array('model'=>$model), 'text/html');


                        try 
                        { 
                            Yii::app()->mail->send($msg);
                            return true;
                        }
                        catch (Swift_SwiftException $e) {die($e);} 
                        catch (Swift_TransportException  $e) {die($e);}
                        catch (Swift_RfcComplianceException  $e) {die($e);}
                        catch (Exception $e) {die($e);}
                    }
                }
                else 
                {
                    throw new Exception('Validation error',500);
                }
                    
            }
            
            $this->render('index_interest',array('model'=>$model));
        }
        protected function performAjaxValidation($model)
        {
            if(isset($_POST['ajax']) && $_POST['ajax']==='interested-clients-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

}