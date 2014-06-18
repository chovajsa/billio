<?php

namespace vendor\angular;

use yii\web\AssetBundle;

/**
 *
 */
class AngularAsset extends AssetBundle
{
    public $sourcePath = '@vendor/angular/dist';
    public $js = [
    	'angular.js',
    	'angular-route.js',
    	'angular-resource.js',
    ];
    public $css = [
    ];
}


