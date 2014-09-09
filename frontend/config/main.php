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
            'cookieValidationKey' => 'xxx'
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
                'PUT api/invoice-in/<id>/approve' => 'api/invoice-in/approve',
                'PUT api/invoice-in/<id>/unapprove' => 'api/invoice-in/unapprove',
                               

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

                'PUT,PATCH api/order-out/<id>' => 'api/order-out/update',
                'DELETE api/order-out/<id>'    => 'api/order-out/delete',
                'GET,HEAD api/order-out/<id>'  => 'api/order-out/view',
                'POST api/order-out'           => 'api/order-out/create',
                'GET,HEAD api/order-out'       => 'api/order-out/index',
                'api/order-out/<id>'           => 'api/order-out/options',
                'api/order-out'                => 'api/order-out/options',
                'PUT api/order-out/<id>/approve' => 'api/order-out/approve',
                'PUT api/order-out/<id>/unapprove' => 'api/order-out/unapprove',
                
                // ['class' => 'yii\rest\UrlRule', 'controller' => ['invoice-in' => 'invoice-in']] ,
            ],
        ]
    ],
    'params' => $params,
];
