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

        'request'=> [
            'enableCsrfValidation' => false,
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
            // 'enableStrictParsing' => true,
            'showScriptName' => false,
            // 'enableStrictParsing'=>false,
            'rules' => [

                'PUT,PATCH api/invoice-in/<id>' => 'api/invoice-in/update',
                'DELETE api/invoice-in/<id>'    => 'api/invoice-in/delete',
                'GET,HEAD api/invoice-in/<id>'  => 'api/invoice-in/view',
                'POST api/invoice-in'           => 'api/invoice-in/create',
                'GET,HEAD api/invoice-in'       => 'api/invoice-in/index',
                'api/invoice-in/<id>'           => 'api/invoice-in/options',
                'api/invoice-in'                => 'api/invoice-in/options',

                'PUT,PATCH api/supplier/<id>'   => 'api/supplier/update',
                'DELETE api/supplier/<id>'  => 'api/supplier/delete',
                'GET,HEAD api/supplier/<id>' => 'api/supplier/view',
                'POST api/supplier' => 'api/supplier/create',
                'GET,HEAD api/supplier' => 'api/supplier/index',
                'api/supplier/<id>' => 'api/supplier/options',
                'api/supplier' => 'api/supplier/options',

                'PUT,PATCH api/order-in/<id>' => 'api/order-in/update',
                'DELETE api/order-in/<id>'    => 'api/order-in/delete',
                'GET,HEAD api/order-in/<id>'  => 'api/order-in/view',
                'POST api/order-in'           => 'api/order-in/create',
                'GET,HEAD api/order-in'       => 'api/order-in/index',
                'api/order-in/<id>'           => 'api/order-in/options',
                'api/order-in'                => 'api/order-in/options',

                // ['class' => 'yii\rest\UrlRule', 'controller' => ['invoice-in' => 'invoice-in']] ,
            ],
        ]
    ],
    'params' => $params,
];
