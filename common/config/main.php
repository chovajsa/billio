<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'urlManager' => [
			'class'=>'common\components\UrlManager',
		    'enablePrettyUrl' => true,
            // 'enableStrictParsing' => true,
            'showScriptName' => false,
		    // 'enableStrictParsing'=>false,
		    'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
		        // your rules go here
		    ],
		],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,//set this property to false to send mails to real email addresses
            //comment the following array to send mail using php's mail function
            // 'transport' => [
            //     'class' => 'Swift_SmtpTransport',
            //     'host' => 'smtp.gmail.com',
            //     'username' => 'username@gmail.com',
            //     'password' => 'password',
            //     'port' => '587',
            //     'encryption' => 'tls',
            // ],
        ],
    ],
];
