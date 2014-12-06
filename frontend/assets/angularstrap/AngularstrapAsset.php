<?php

namespace frontend\assets\angularstrap;

use yii\web\AssetBundle;

class AngularstrapAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/angularstrap/dist';

    public $js = [
    	'angular-strap.min.js',
    	'angular-strap.tpl.min.js',
    ];

}
