<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use common\components\Document;

/**
 * Invoice In controller
 */
class InvoiceInController extends Controller
{
 
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'print'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'attachments', 'get-attachment', 'getAttachment', 'generate-payment-file'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],

        ];
    }
    /**
     * @inheritdoc	
     */
    public function actions()
    {
        return [
            'index',
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionGetAttachment($id, $fileName) {
       
	    $fileStoragePath = \common\models\Settings::getFileStoragePath();
		
		$fileDestination = $fileStoragePath.'/'.$id;
		
		if (!file_exists($fileDestination)) {
			if (!mkdir($fileDestination)) {
				throw new Exception('cannot create folder');
			}
		}
		
		if(substr($fileName,-13) == 'invoiceIn.pdf') {
			
			$file = $fileDestination.'/'.$id.'-invoiceIn.pdf';
		
			Document::createInvoice($id);
			
			$this->sendFile($file);	
			
		} else {
			$this->sendFile($file);	
		}
    }
	
	private function sendFile($file) {
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Type: application/".pathinfo($file, PATHINFO_EXTENSION));
		header("Content-Disposition: attachment; filename=".basename($file));
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".filesize($file));
		
		readfile($file);
		exit();
	}

    public function actionAttachments() {
        $this->layout = 'clean';

        if (isset($_FILES['attachment']) && isset($_GET['invoiceInId'])) {

            $fileStoragePath = \common\models\Settings::getFileStoragePath();

            $fileDestination = $fileStoragePath.'/'.$_GET['invoiceInId'];

            if (!file_exists($fileDestination)) {
                mkdir($fileDestination);
            }

            $destination = $fileDestination.'/'.$_FILES["attachment"]["name"];
            
            move_uploaded_file($_FILES["attachment"]["tmp_name"], $destination);
        }

        $attachments = [];
        if (isset($_GET['invoiceInId'])) { 
            $invoiceIn = \common\models\InvoiceIn::findOne($_GET['invoiceInId']);
            $attachments = $invoiceIn->getAttachments();
        }

        return $this->render('attachments', [
            'id'=>isset($_GET['invoiceInId']) ? $_GET['invoiceInId'] : null,
            'attachments' => $attachments
        ]);
    }

    public function actionGeneratePaymentFile() {

        $paymentRows = array();

        foreach ($_POST['Invoice'] as $id=>$attributes) {
            $invoice = \common\models\InvoiceIn::findOne($id);

            /*

            $this->currency,
            $this->amount,
            '4150047806',
            $this->date,
            $this->dueDate,
            $this->bankAccount,
            $this->bankAccountPrefix,
            $this->bankAccountCode,
            $this->ks,
            $this->ss,
            1,
            $this->note1,
            $this->note2,
            $this->note3,
            $this->note4

            */

            $row = new \common\components\BankRow;
            $row->amount = $attributes['amount'];

            if (isset($attributes['account'])) {
                $bankAccount = explode('/',$attributes['account']);
                $row->bankAccount = $bankAccount[0];
                $row->bankAccountCode = $bankAccount[1];            
            } else {
            }

            $row->bankAccountPrefix = '0';
            $row->vs = $invoice->referenceNumber;

            $paymentRows[] = $row;
               
        }

        $content = \common\components\Sberbank::createFile($paymentRows);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
        header("Content-Type: application/csv");
        header("Content-Disposition: attachment; filename=".time().".dlm");
        header("Content-Transfer-Encoding: binary");
        // header("Content-Length: ".filesize($file));

        echo $content;

        die();
    }

    public function actionIndex() {
        return $this->render('index');
    }
	
	public function actionPrint() {

		if (isset($_GET['invoiceInId'])) { 
            $invoiceIn = \common\models\InvoiceIn::findOne($_GET['invoiceInId']);
			// $supplier = \common\models\Supplier::findOne($invoiceIn->supplierId);
			// $invoiceInRows = \common\models\InvoiceInRow::findAll(['invoiceInId' => $invoiceIn->id]);
        
			$this->layout = 'print';
			return $this->render('print',[
				'invoiceIn' => $invoiceIn,
				// 'supplier' => $supplier,
				// 'invoiceInRows' => $invoiceInRows,
			]);
		
		} else {
			throw new Exception("no invoiceInId");
		}
		
    }
 
}
