<?php 

namespace common\components;


class Notifier {

	public static function notifyNewInvoice($invoice){

		try {
			$users = \common\models\User::find()->all();

			$message = \Yii::$app->mail->compose('newInvoice', ['invoice'=>$invoice])
			->setFrom([\Yii::$app->params['supportEmail'] => 'Trila IPT - Notifications'])
		    ->setSubject('New Invoice' )
		    
			$emails = array();

			foreach ($users as $user) {
				if ($user->wantsNewInvoiceMessage()) {
					$emails[] = $user->email;
				}
			}

			if ($emails) {
				$message->setTo($emails);
		   		$message->send();
			}	
		} catch(Exception $e) {

		}
	}

	public static function notifyUpdateInvoice($invoice) {
		try {
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
	    } catch(Exception $e) {

		}
	}

	public static function notifyPaid($invoice) {
		try {
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
		} catch(Exception $e) {

		}
	}

	public static function notifyApproved($invoice) {
		try {
			$users = \common\models\User::find()->all();

			$message = \Yii::$app->mail->compose('approved', ['invoice'=>$invoice])
				->setFrom([\Yii::$app->params['supportEmail'] => 'Trila IPT - Notifications'])
			    ->setSubject('Invoice Approved' );
			
			$emails = array();

			foreach ($users as $user) {
				if ($user->wantsApprovedMessage()) {
					$emails[] = $user->email;
				}
			}

			if ($emails) {
				$message->setTo($emails);
			    $message->send();
			}
		} catch (Exception $e) {

		}
	}

}
