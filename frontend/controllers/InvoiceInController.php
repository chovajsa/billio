<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;

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
                        'actions' => ['logout', 'index', 'attachments', 'get-attachment', 'getAttachment'],
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
        echo "$id $fileName";
        die();
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
