<?php

namespace common\components;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * @author Miroslav Kanovsky
 */
class Helpers
{

	/**
	* Obtains an object class name without namespaces
	*/
	public static function get_real_class($obj) {
	    $classname = get_class($obj);

	    if (preg_match('@\\\\([\w]+)$@', $classname, $matches)) {
	        $classname = $matches[1];
	    }

	    return $classname;
	}

}