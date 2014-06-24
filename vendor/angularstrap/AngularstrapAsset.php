<?php

namespace vendor\angularstrap;

use yii\web\AssetBundle;

class AngularstrapAsset extends AssetBundle
{
    public $sourcePath = '@vendor/angularstrap/dist';

    public $js = [
    	'angular-strap.min.js',
    	'angular-strap.tpl.min.js',
    	'bootstrap-select.js'
    ];

}
