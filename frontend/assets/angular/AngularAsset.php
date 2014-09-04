<?php

namespace frontend\assets\angular;

use yii\web\AssetBundle;

/**
 *
 */
class AngularAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/angular/dist';
    public $js = [
    	'angular.js',
    	'angular-route.js',
    	'angular-resource.js',
    ];
    public $css = [
    ];
}


