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
		]
    ],
];
