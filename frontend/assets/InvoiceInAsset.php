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
class InvoiceInAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $sourcePath = '@webroot/js/invoiceIn';
    
    public $baseUrl = '@web';

    public $js = [
        'js/invoiceIn/app.js',
        // 'js/invoiceIn/providers.js',
        // 'js/invoiceIn/list.js',
    ];

}
