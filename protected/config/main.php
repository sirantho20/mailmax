<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Mail Max',
        'theme'=>'bootstrap',
        'defaultController' => 'site/index',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.extensions.zimbra.*',
                'ext.yii-mail.YiiMailMessage',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'imail',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths'=>array(
                                'bootstrap.gii',
                            ),
		),
		
	),

	// application components
	'components'=>array(
                    
		'user'=>array(
			// enable cookie-based authentication
                        'loginUrl'=>array('login/index'),
			'allowAutoLogin'=>true,
                        'class'=>'WebUser',
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*'db'=>array(
			'connectionString' => 'mysql:'.dirname(__FILE__).'/../data/testdrive.db',
		), */
		// uncomment the following to use a MySQL database
		'bootstrap'=>array(
                        'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
                    ),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=imail',
			'emulatePrepare' => true,
			'username' => 'imail',
			'password' => 'imail',
			'charset' => 'utf8',
		),
                'mail' => array(
 			'class' => 'ext.yii-mail.YiiMail',
 			//'transportType' => 'php', //use this if on live server
                            'transportType'=>'smtp',
                            'transportOptions'=>array(
                            'host'=>'ssl://mail2.i-webb.net',
                            'username'=>'admin@mail2.i-webb.net',
                            'password'=>'AFtony19833',
                            'port'=>'465',
                         ),
 			'viewPath' => 'application.views.mail',
			'logging' => true,
 			'dryRun' => false,
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'error/index',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'sirantho20@gmail.com',
                'zimbraServer'=>'mail2.i-webb.net',
                'zimbraAdminLogin'=>'admin@mail2.i-webb.net',
                'zimbraAdminPassword'=>'AFtony19833',
                'zmQuotaFactor'=>'1048576',
                'noReply'=>'jobs@softcube.co', 
                'emailFrom'=>'admin@mail2.i-webb.net',
                'mailSupportEmail'=>'info@softcube.co',
                'mxHosts'=>'mail2.i-webb.net',
	),
);