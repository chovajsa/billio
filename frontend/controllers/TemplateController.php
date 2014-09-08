<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class TemplateController extends Controller {

	public function actionIndex($route) {
		$this->layout = 'empty';

		return $this->render($route, array());

	}


}