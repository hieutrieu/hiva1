<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Hieu Tam',
    'sourceLanguage'=>'en',
	'language'=>'vi',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'ext.giix-components.*', // giix components
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths'=>array(
    			'ext.giix-core', // giix generators
    		),
		),'admin',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
			'caseSensitive' => false,
			'appendParams' => false,
            'urlSuffix' => '.html',
            'cacheID' => 'cache',
            'class' => 'RewriteUrlManager',
        ),
		

		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=tamhieu',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
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
        /*'clientScript' => array(
            'class' => 'CClientScript',
            'coreScriptPosition' => CClientScript::POS_END,
            'defaultScriptFilePosition' => CClientScript::POS_END,
            'defaultScriptPosition' => CClientScript::POS_READY,
        ),*/
        'email'=>array(
            'class'=>'application.extensions.email.Email',
            'delivery'=>'debug', //Will use the php mailing function.  
            //May also be set to 'debug' to instead dump the contents of the email into the view
        ),
		'settings'=>array(
			'class'             => 'CmsSettings',
		),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'contactRequireCaptcha' => true,
        // this is used in contact page
		'adminEmail'=>'tamhieu.com.vn@gmail.com',
	),
);