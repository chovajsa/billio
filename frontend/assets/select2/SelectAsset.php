<?php

namespace frontend\assets\select2;

use yii\web\AssetBundle;

/**
 *
 */
class SelectAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/select2/';
    public $js = [
    	'select2.min.js',
    ];
    public $css = [
    	'select2.css'
    ];
}


