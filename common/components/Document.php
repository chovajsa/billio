<?php

namespace common\components;

use Yii;
use yii\helpers\Url;

class Document
{

	public static function createInvoice($id, $header = false) {
		
		$url = Url::toRoute(['invoice-in/print', 'invoiceInId' => $id,]);

		// echo $url;
		
		// $user = Yii::$app->params['self_http_user'];
		// $password = Yii::$app->params['self_http_passwrod'];

		// $up = '';
		// if (isset(Yii::$app->params['httpauth'])) {
			
			// $arr = explode(':', Yii::app()->params['httpauth']);
			// $user = $arr[0];
			// $password = $arr[1];

			// $up = '--username '.$user.' --password '.$password;
		
		// }

		$outputFolder = \common\models\Settings::getFileStoragePath().'/'.$id.'/';
		
		if (!file_exists($outputFolder)) {
    		if (!mkdir($outputFolder, 0777, true)) {
    			throw new Exception('cannot create folder');
			}
		}

		$fileName = $id.'-invoiceIn.pdf';

		$command = '/bin/wkhtmltopdf-amd64 --orientation portrait --dpi 300 --zoom 0.75  --page-size A4 --margin-top 0mm --margin-left 0mm --margin-right 0mm --margin-bottom 0mm --quiet --use-xserver "'.$url.'" "'.$outputFolder.'/'.$fileName.'"';
		
		return shell_exec($command);
	}

}