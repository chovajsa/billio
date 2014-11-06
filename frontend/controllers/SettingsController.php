<?php
namespace frontend\controllers;

use Yii;

use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;

/**
 * Site controller
 */
class SettingsController extends Controller
{

	// public function init() {
				
	// }

	public function actionIndex() {

		$user = new User;

		return $this->render('index', ['user'=>$user]);
	}

	public function actionChangePassword() {
		
		$user = new User;
		// var_dump($_POST);

		if (isset($_POST['User'])) {
			if (!$_POST['User']['oldPassword'] || !Yii::$app->user->identity->validatePassword($_POST['User']['oldPassword'])) {
				Yii::$app->session->setFlash('danger', 'Current password is invalid');
				return $this->redirect(['index']);
			}

		    $re = "/^(?=.*\\d)[0-9A-Za-z!_@#$%*]{1,}$/";
		    

			if (!$_POST['User']['newPassword']  || !$result = preg_match($re,  $_POST['User']['newPassword'])) {
				Yii::$app->session->setFlash('danger', 'New password do not meet requirements');
				return $this->redirect(['index']);
			}

			if ($_POST['User']['newPassword'] != $_POST['User']['newPasswordCheck']) {
				Yii::$app->session->setFlash('danger', 'New password and check do not match');
				return $this->redirect(['index']);
			}

			Yii::$app->user->identity->setPassword($_POST['User']['newPassword']);
			$saved = Yii::$app->user->identity->save();
			if ($saved) {
				Yii::$app->session->setFlash('success', 'Password is succesfully changed');	
				return $this->redirect(['index']);
			}

		}
	}	

}