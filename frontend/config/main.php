<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    
    'modules' => [
        'api' => [
            'class'=>'frontend\modules\api\ApiModule',

        ]
    ],

    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
            'class'=>'common\components\UrlManager',
            'enablePrettyUrl' => true,
            // 'enableStrictParsing' => true,
            'showScriptName' => false,
            // 'enableStrictParsing'=>false,
            'rules' => [

                'PUT,PATCH api/invoicein/<id>' => 'api/invoicein/update',
                'DELETE api/invoicein/<id>' => 'api/invoicein/delete',
                'GET,HEAD api/invoicein/<id>' => 'api/invoicein/view',
                'POST api/invoicein' => 'api/invoicein/create',
                'GET,HEAD api/invoicein' => 'api/invoicein/index',
                'api/invoicein/<id>' => 'api/invoicein/options',
                'api/invoicein' => 'api/invoicein/options',

                'PUT,PATCH api/supplier/<id>' => 'api/supplier/update',
                'DELETE api/supplier/<id>' => 'api/supplier/delete',
                'GET,HEAD api/supplier/<id>' => 'api/supplier/view',
                'POST api/supplier' => 'api/supplier/create',
                'GET,HEAD api/supplier' => 'api/supplier/index',
                'api/supplier/<id>' => 'api/supplier/options',
                'api/supplier' => 'api/supplier/options',

                // ['class' => 'yii\rest\UrlRule', 'controller' => ['invoice-in' => 'invoice-in']] ,
            ],
        ]
    ],
    'params' => $params,
];
