<?php

class DashboardController extends Controller
{
   // public $layout='//layouts/dashboard';
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
                    'users'=>array('@'),
                ),
                array('deny',  // deny all usersl
                    'users'=>array('*'),
                ),
            );
        }
	public function actionIndex()
	{
            $zm = new yiiZimbra();
            $ac = new Account();
            //echo $zm->getAccountPackageDiskUsagePercent();die();
            //echo $zm->reverseDomainAccounts(Yii::app()->user->accountdomain);
//            $rec = $zm->getDistributionListMembers('05a169b0-aeef-4dc8-99e4-a94577cc99fd'/*'operations@bullion.com.gh'*/);
//            print_r($rec);
            
            //echo $zm->getDistributionListId('operations@bullion.com.gh',  Yii::app()->user->accountdomain);die();
            //print_r($zm->getDomainDistributionList(Yii::app()->user->accountdomain));
            //$zm->reverseDomainAccounts(Yii::app()->user->accountdomain);
            //print_r($zm->getTopDiskUsers(Yii::app()->user->accountdomain));
            $top5 = $zm->getTopDiskUsers(Yii::app()->user->accountdomain);
            $percent = $ac->getAccountPackageDiskUsagePercent();
            $domainUsedDisk = $zm->getDomainDiskUsage(Yii::app()->user->accountdomain);
            $provisioned = $ac->getAccountPackageDiskLimit();
            $emailLimit = $ac->getAccountPackageEmailLimit();
            $emailsCreated = $ac->getAccountEmailsCount();
            $emailsCreatedPercent = $ac->getAccountEmailsCreatePercent();
            $this->render('index',array('domainUsedDisk'=>$domainUsedDisk,'provisioned'=>$provisioned,'percent'=>$percent,'top5'=>$top5,'emailLimit'=>$emailLimit,'emailsCreated'=>$emailsCreated,'emailsCreatedPercent'=>$emailsCreatedPercent));
	}


	
}