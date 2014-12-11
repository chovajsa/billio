<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\components;



/**
 * @param Request $request 
*/
class UrlManager extends \yii\web\UrlManager
{

	public function parseRequest($request)
    {
    	$pathInfo = $request->getPathInfo();
    	$pathInfo = strtolower($pathInfo);
    	$request->setPathInfo($pathInfo);

    	return parent::parseRequest($request);
	}
}