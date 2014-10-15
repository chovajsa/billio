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

                'GET,HEAD api/invoice-in/get-iban'  => 'api/invoice-in/get-iban',
                'PUT,PATCH api/invoice-in/mark-as-paid' => 'api/invoice-in/mark-as-paid',
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
				
				'PUT,PATCH api/cost-centre/<id>'   => 'api/cost-centre/update',
                'DELETE api/cost-centre/<id>'  => 'api/cost-centre/delete',
                'GET,HEAD api/cost-centre/<id>' => 'api/cost-centre/view',
                'POST api/cost-centre' => 'api/cost-centre/create',
                'GET,HEAD api/cost-centre' => 'api/cost-centre/index',
                'api/cost-centre/<id>' => 'api/cost-centre/options',
                'api/cost-centre' => 'api/cost-centre/options',

                
                ['class' => 'yii\rest\UrlRule', 'controller' => ['invoice-in' => 'invoice-in']] ,
            ],
        ]
    ],
    'params' => $params,
];
