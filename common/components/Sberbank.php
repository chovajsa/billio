<?php 

namespace common\components;



class Sberbank {

	public static function createFile($data) {

		$content = "";

		foreach ($data as $r) {
			$row = implode('|', $r->getArray());
			$content .= $row."\n";
		}

		return $content;

	}

}