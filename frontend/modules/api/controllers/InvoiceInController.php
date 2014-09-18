<?php 

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\data\ActiveDataProvider;
use Yii;


class InvoiceInController extends ActiveRestController
{
    public $modelClass = 'common\models\InvoiceIn';



	/**
     * Checks the privilege of the current user.
     *
     * This method should be overridden to check whether the current user has the privilege
     * to run the specified action against the specified data model.
     * If the user does not have access, a [[ForbiddenHttpException]] should be thrown.
     *
     * @param string $action the ID of the action to be executed
     * @param object $model the model to be accessed. If null, it means no specific model is being accessed.
     * @param array $params additional parameters
     * @throws ForbiddenHttpException if the user does not have access
     */
    public function checkAccess($action, $model = null, $params = [])
    {
    	return true;
    }

	/**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            // 'index' => [
                // 'class' => 'yii\rest\IndexAction',
                // 'modelClass'=>$this->modelClass
            // ],
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            // 'create' => [
                // 'class' => 'yii\rest\CreateAction',
                // 'modelClass' => $this->modelClass,
                // 'checkAccess' => [$this, 'checkAccess'],
                // 'scenario' => $this->createScenario,
            // ],
            // 'update' => [
            //     'class' => 'yii\rest\UpdateAction',
            //     'modelClass' => $this->modelClass,
            //     'checkAccess' => [$this, 'checkAccess'],
            //     'scenario' => $this->updateScenario,
            // ],
            'delete' => [
                'class' => 'yii\rest\DeleteAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ],
        ];
    }

    
    public function actionApprove($id) {
        $invoiceIn = \common\models\InvoiceIn::findOne($id);
        $approved = $invoiceIn->approve();
       
        return $invoiceIn;
    }

    public function actionUnapprove($id) {
        $invoiceIn = \common\models\InvoiceIn::findOne($id);
        $invoiceIn->unapprove();   
        return $invoiceIn;
    }

    public function actionCreate() {
        $invoiceIn = new \common\models\InvoiceIn;
        $p = Yii::$app->getRequest()->getBodyParams();
        $invoiceIn->load($p, '');

        $invoiceIn->createdBy = Yii::$app->user->id;
        $invoiceIn->createdDate = date('Y-m-d H:i:s');
        
        $invoiceIn->save();
        return $this->update($invoiceIn);
    }

    public function actionUpdate($id) {
        $invoiceIn = \common\models\InvoiceIn::findOne($id);
        return $this->update($invoiceIn);
    }

    public function update($invoiceIn) {
        $p = Yii::$app->getRequest()->getBodyParams();
        
        $invoiceIn->load($p, '');
        $invoiceIn->save();

        if (isset($p['rows']) && !empty($p['rows'])) {
            foreach ($p['rows'] as $prow) {
                if (!isset($prow['id']) || !$prow['id']) {
                    $row = new \common\models\InvoiceInRow();
                    $row->invoiceInId = $invoiceIn->id;
                    $row->setAttributes($prow, '');

                    $row->amountTotal = $row->pcs * $row->amount;
                    $row->amountTotalVat = $row->amountTotal + $row->vat * $row->pcs;

                    $row->save();
                } else 
                foreach ($invoiceIn->rows as $row) {
                    if ($prow['id'] == $row->id) {
                        $row->setAttributes($prow, '');
                   
                        $row->amountTotal = $row->pcs * $row->amount;
                        $row->amountTotalVat = $row->amountTotal + $row->vat * $row->pcs;
                        $row->save();

                        $row->save();
                    }
                }
            }
        }

        if (!empty($p['toDelete'])) {
            foreach ($p['toDelete'] as $x) {
                $r = \common\models\InvoiceInRow::findOne($x['id']);
                $r->delete();
            }
        }

        $invoiceIn->refresh();
        $invoiceIn->amount = 0;
        $invoiceIn->amountVat = 0;
        $invoiceIn->vat = 0;

        //= amount  pcs vat amountTotal amountTotalVat
        // amount  decimal(10,2) NULL   
        // amountVat   decimal(10,2) NULL   
        // vat
        
        foreach ($invoiceIn->rows as $row) {
            $invoiceIn->amount += $row->amountTotal;
            $invoiceIn->amountVat += ($row->amountTotalVat);
            $invoiceIn->vat += $row->vat;
        } 

        $invoiceIn->save();

        return $invoiceIn;
    }

    

	public function actionIndex() {
    	
        $dataProvider = $this->prepareDataProvider('supplier');

        return $dataProvider;
    }


}