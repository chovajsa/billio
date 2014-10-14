<?php 
namespace console\controllers;

class UserController extends \yii\console\Controller
{
 
    public function actionManage($name, $email, $password, $groups) {

    	$user = \common\models\User::findOne(['username' => $name]);

    	if (!$user)
    	$user = new \common\models\User;

    	$user->username = $name;
    	$user->email = $email;
    	$user->setPassword($password);

    	$groups = explode(',', $groups);
    	$user->meta = json_encode(array('groups'=>$groups));

    	$user->save(false);
    
    }

}