<?php

class GroupsController extends Controller
{
    
        public $layout='//layouts/sidebar';
        public $sidebar;
        
        public function init() {
            $side = new sideBar();
            $side->addList('New Group', $this->createUrl('create'), 'createNewGroup')
                 ->addList('Manage Groups', $this->createUrl('index'), 'manageDLgroups');
            $this->sidebar = $side->getSideBar();
            parent::init();
        }
        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
        public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


        public function actionCreate()
	{
            $zm = new yiiZimbra();
            $model = new DistributionListForm();
            
             if(isset($_POST['ajax']) && $_POST['ajax']==='distribution-list-form')
                {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
                }
    
            if(isset($_POST['DistributionListForm']))
                {
                    $model->attributes=$_POST['DistributionListForm'];
                    if($model->validate())
                    {
                        $email = $model->email.'@'.Yii::app()->user->accountdomain;
                        $options = array('name'=>$email,'displayName'=>$model->name,);
                        if($zm->createDistributionList($options))
                        {
                            Yii::app()->user->setFlash('success',"Group $model->name successfully created.");
                            die('ok');
                        }
                        else 
                        {
                            $zm->error_msg=='distribution list already exists'?$msg='Group already exists.':'';
                            throw new CHttpException(500,$msg);
                        }
                    } 
                    else 
                    {
                        
                    }
                }
                
                $this->renderPartial('create',array('model'=>$model));
	}
        
        public function actionUpdate($dlid)
        {
            $model = new DistributionListForm('update');
            $zm = new yiiZimbra();
            $re = $zm->getDistributionList($dlid);
            $model->name = $re['name'];
            //print_r($re);die();
            $m = explode('@', $re['email']);
            $model->email = $m[0];
            if(isset($_POST['DistributionListForm']))
            {
                $model->attributes=$_POST['DistributionListForm'];
                    if($model->validate())
                    {
                        //die($model->email);
                        $options = array('id'=>$dlid,'displayName'=>$model->name,'name'=>$model->email.'@'.Yii::app()->user->accountdomain);
                        //print_r($options);die();
                        if($zm->modifyDistributionList($options))
                        {
                            Yii::app()->user->setFlash('success','Update successfully saved');
                        }
                        else 
                        {
                            Yii::app()->user->setFlash('error','Error saving update. '.$zm->error_msg);
                        }
                    } 
                    else 
                    {
                        
                    }
            }
            $this->render('update',array('model'=>$model));
        }

        public function actionIndex()
	{
            $zm = new yiiZimbra();
            if(isset($_POST['group']) && $_POST['group'] !='')
		{
                    $group = $_POST['group'];
                    $allUsers = $zm->getAccounts(Yii::app()->user->accountdomain);
                    foreach ($allUsers as $user)
                    {
                        $zm->removeDistributionListMember($group, $user);
                    }
                    foreach ($_POST as $key=>$value)
                    {
                         if($value =='member')
                         {
                             //echo $key.', ';
                             $key2 = str_replace('_', '.', $key);
                            // $zm->removeDistributionListMember($group, $key2);
                             if($zm->addDistributionListMember($group, $key2))
                             {
                                 
                             }
                             else 
                             {
                                 die($zm->error_msg);
                             }
                         }
                    }
                }
            
            $groups = $zm->getDomainDistributionLists(Yii::app()->user->accountdomain);
		$this->render('index',array('groups'=>$groups));
	}
        public function actionPopulateGroupMembers($group)
        {
            $result = '';
            $zm = new yiiZimbra();
            $mem = $zm->getDistributionListMembers($group);
            //print_r($mem);die();

            $allUsers = $zm->getAccounts(Yii::app()->user->accountdomain);
            natsort($allUsers);
            //print_r($allUsers);die();
            foreach($allUsers as $account)
            {
                $detail = $zm->getAccount($account);
                if(in_array($detail['email'], $mem))
                {
                    $result .='<span class="groupMember"><input id="memberChk" style="margin-right:5px;" type="checkbox" name="'.$detail['email'].'" value="'.'member'.'" checked>'.$detail['givenName'].' '.$detail['sn'].'</input></span>';
                }
                else 
                {
                    $result .='<span class="groupMember"><input id="memberChk" style="margin-right:5px;" type="checkbox" name="'.$detail['email'].'" value="'.'member'.'">'.$detail['givenName'].' '.$detail['sn'].'</input></span>';
                }
            }
            
            $result .='<input class="hidden" type="" value="'.$group.'" name="group" />';
            
            echo $result;
        }
        
        protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='distribution-list-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionRemove($id)
        {
            $zm = new yiiZimbra();
            if($zm->deleteDistributionList($id))
            {
                Yii::app()->user->setFlash('success',"Group successfully deleted.");
                die('Group successfully deleted');
            }
            else  
            {
                throw new CHttpException(500,'Error processing. '.$zm->error_msg);
            }
        }
        
        
}