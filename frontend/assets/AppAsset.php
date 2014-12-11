<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
<<<<<<< HEAD

    public $depends = [
        // 'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        '\frontend\assets\angularstrap\AngularstrapAsset',
        '\frontend\assets\admintemplate\AdminAsset',
        '\frontend\assets\angular\AngularAsset',
        '\frontend\assets\select2\SelectAsset',
=======
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
>>>>>>> 5214b3a... initial commit with a little structure
    ];
}
