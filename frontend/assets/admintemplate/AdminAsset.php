<?php

namespace frontend\assets\admintemplate;

use yii\web\AssetBundle;

/**
 *
 */
class AdminAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/admintemplate/assets';

    // public $js = [
    	// 'angular.js',
    	// 'angular-route.js',
    	// 'angular-resource.js',
    // ];
    
    public $css = [
    	'plugins/font-awesome-4.1.0/css/font-awesome.min.css',
    	'css/animate.min.css',
    	'css/style.min.css',
    	'css/style-responsive.min.css',

    	// page level
    	// 'plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css',
    	'plugins/bootstrap-datepicker/css/datepicker.css',
    	'plugins/bootstrap-datepicker/css/datepicker3.css',
        // 'plugins/bootstrap-select/bootstrap-select.css',
    	// 'plugins/gritter/css/jquery.gritter.css'
    ];

    public $js = [
        'plugins/jquery-1.8.2/jquery-1.8.2.min.js',
        'plugins/jquery-ui-1.10.4/ui/minified/jquery-ui.min.js',
        'plugins/bootstrap-3.1.1/js/bootstrap.min.js',

        // 'plugins/slimscroll/jquery.slimscroll.min.js',
        // 'plugins/gritter/js/jquery.gritter.js',

        // page level

        // 'plugins/gritter/js/jquery.gritter.js',
        // 'plugins/flot/jquery.flot.min.js',
        // 'plugins/flot/jquery.flot.time.min.js',
        // 'plugins/flot/jquery.flot.resize.min.js',
        // 'plugins/flot/jquery.flot.pie.min.js',
        // 'plugins/sparkline/jquery.sparkline.js',
        // 'plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js',
        // 'plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js',
        'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',

        // 'plugins/bootstrap-select/bootstrap-select.js',
        // 'js/dashboard.min.js',
        // 'js/apps.min.js',
    ];
}


