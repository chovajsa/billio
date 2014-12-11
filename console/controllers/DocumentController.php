<?php 
namespace console\controllers;
use yii\helpers\VarDumper;
use common\components\Document;

class DocumentController extends \yii\console\Controller
{
  
    public function actionFind($invoiceInId) {

    	$invoice = \common\models\InvoiceIn::findOne($invoiceInId);

    	if($invoice) { 
			VarDumper::dump($invoice,5,0);
			die;
		}
		else { 
			return false;
		}
    
    }
	
	public function actionCreate($invoiceInId) {
    	
		Document::createInvoice($invoiceInId);
    
    }

}