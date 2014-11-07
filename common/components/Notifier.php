<?php 

namespace common\components;


class Notifier {

	public static function notifyNewInvoice($invoice){
		$users = \common\models\User::find()->all();

		foreach ($users as $user) {
			if ($user->wantsNewInvoiceMessage()) {
				\Yii::$app->mail->compose('newInvoice', ['invoice'=>$invoice])
				->setFrom([\Yii::$app->params['supportEmail'] => 'Trila IPT - Notifications'])
			    ->setTo($user->email)
			    ->setSubject('New Invoice' )
			    ->send();
			}
		}
	}

	public static function notifyUpdateInvoice($invoice) {
		$users = \common\models\User::find()->all();

		foreach ($users as $user) {
			if ($user->wantsNewInvoiceMessage()) {
				\Yii::$app->mail->compose('updateInvoice', ['invoice'=>$invoice])
				->setFrom([\Yii::$app->params['supportEmail'] => 'Trila IPT - Notifications'])
			    ->setTo($user->email)
			    ->setSubject('Invoice Updated' )
			    ->send();
			}
	    }
	}

	public static function notifyPaid($invoice) {
		$users = \common\models\User::find()->all();

		foreach ($users as $user) {
			if ($user->wantsPaidMessage()) {
				\Yii::$app->mail->compose('paid', ['invoice'=>$invoice])
				->setFrom([\Yii::$app->params['supportEmail'] => 'Trila IPT - Notifications'])
			    ->setTo($user->email)
			    ->setSubject('Invoice(s) paid' )
			    ->send();
			}
		}
	}

	public static function notifyApproved($invoice) {

		$users = \common\models\User::find()->all();

		foreach ($users as $user) {
			if ($user->wantsApprovedMessage()) {
				\Yii::$app->mail->compose('approved', ['invoice'=>$invoice])
				->setFrom([\Yii::$app->params['supportEmail'] => 'Trila IPT - Notifications'])
			    ->setTo($user->email)
			    ->setSubject('Invoice Approved' )
			    ->send();
			}
		}
	}

}
