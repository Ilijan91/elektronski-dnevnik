<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'teachers' => [
            'class' => 'frontend\modules\teachers\Module',
        ],
        'parent' => [
            'class' => 'frontend\modules\parent\Module',
        ],
        'director' => [
            'class' => 'frontend\modules\director\Module',
        ],
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-common', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-common',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
        'urlManagerBackend' => [

        	'class' => 'yii\web\urlManager',

        	'baseUrl' => 'http://localhost/dnevnik/backend/web',

        	'enablePrettyUrl' => true,

        	'showScriptName' => false,

    	],
    ],
    'params' =>[
        'params'=>$params,
        'school_name'=>'osnovna skola "8.oktobar"',
        'school_phone'=>'063/100-222',
        'school_mail'=>'schoolname@school.com',
    ],
];
