<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Invoice In controller
 */
class OrderOutController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'attachments'],
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

    public function actionAttachments() {
        $this->layout = 'clean';

        if (isset($_FILES['attachment']) && isset($_GET['orderOutId'])) {

            $fileStoragePath = \common\models\Settings::getFileStoragePath();

            $fileDestination = $fileStoragePath.'/'.$_GET['orderOutId'];

            if (!file_exists($fileDestination)) {
                mkdir($fileDestination);
            }

            $destination = $fileDestination.'/'.$_FILES["attachment"]["name"];
            
            move_uploaded_file($_FILES["attachment"]["tmp_name"], $destination);
        }

        $attachments = [];
        if (isset($_GET['orderOutId'])) { 
            $orderOut = \common\models\OrderOut::findOne($_GET['orderOutId']);
            $attachments = $orderOut->getAttachments();
        }

        return $this->render('attachments', [
            'id'=>isset($_GET['orderOutId']) ? $_GET['orderOutId'] : null,
            'attachments' => $attachments
        ]);
    }

    public function actionIndex() {
    	return $this->render('index');
    }
 
}
