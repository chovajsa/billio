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
	
	public static function formatDateFromDb($date, $noTime = false) {
	   $format = 'd.m.Y';
		if (strlen($date) > 10) {

			if (!$noTime)
				$format .= ' H:i:s';

		}
		$time = strtotime($date);
		if ($time)
			$date = date($format, $time);
		else $date = '';
		return $date;
	}

	public static function formateDateToDb($date) {
		$object = DateTime::createFromFormat('d.m.Y', $date);
		if ($object) {
			$time = $object->getTimestamp();
			return date('Y-m-d', $time);
		} else {
			return false;
		}
	}

}