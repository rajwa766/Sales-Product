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
    'bootstrap' => ['log',
    [
         'class' => 'common\components\LanguageSelector',
         'supportedLanguages' => ['en_US', 'th-TH'],
     ],
 ],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => ['admin' => [
        'layout' => '//left-menu',
         'class' => 'mdm\admin\Module',
         'controllerMap' => [
         'assignment' => [
             'class' => 'mdm\admin\controllers\AssignmentController',
             'userClassName' => 'common\models\User',
             'idField' => 'user_id'
         ],
     
     ],
 ],

     ],
    'components' => [
 
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
      ],
        
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
         'allowActions' => [
             'site/*',
             'order/create',
             'order/view',
             
             'some-controller/some-action',
             // The actions listed here will be allowed to everyone including guests.
             // So, 'admin/*' should not appear here in the production, of course.
             // But in the earlier stages of your development, you may probably want to
             // add a lot of actions here until you finally completed setting up rbac,
             // otherwise you may not even take a first step.
        ]
     ],
    'params' => $params,
];
