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

    public function actionDecline($id) {
        $invoiceIn = \common\models\InvoiceIn::findOne($id);
        $declined = $invoiceIn->decline();
       
        return $invoiceIn;
    }

    public function actionCreate() {
        $invoiceIn = new \common\models\InvoiceIn;
        $p = Yii::$app->getRequest()->getBodyParams();
        $invoiceIn->load($p, '');

        $invoiceIn->createdBy = Yii::$app->user->id;
        $invoiceIn->createdDate = date('Y-m-d H:i:s');
        
        $invoiceIn->save();
        $result = $this->update($invoiceIn);
        \common\components\Notifier::notifyNewInvoice($invoiceIn);
        return $result;
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

                    $vat = 0;
                    $supplier = \common\models\Supplier::findOne($invoiceIn->supplierId);
                    if ($supplier) {
                        if ($supplier->vat) {
                            $vat = $row->vat;
                        } else {
                            $vat = 0;
                        }
                    }

                    $row->amountTotalVat = ($row->amountTotal * (1+$vat/100));

                    $row->save();
                } else 
                foreach ($invoiceIn->rows as $row) {
                    if ($prow['id'] == $row->id) {
                        $row->setAttributes($prow, '');
                   
                        $vat = 0;
                        $supplier = \common\models\Supplier::findOne($invoiceIn->supplierId);
			if ($supplier && $supplier->vat) $vat=$row->vat; 
                        $row->amountTotal = $row->pcs * $row->amount;
                        $row->amountTotalVat = ($row->amountTotal * (1+$vat/100));
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
	
	protected function prepareDataProvider($with = []) {
       	
        $dataProvider = parent::prepareDataProvider($with);
		
		$dataProvider->query->leftJoin("supplier","supplier.id = invoiceIn.supplierId");
		$dataProvider->query->leftJoin("costCentre","costCentre.id = invoiceIn.costCentreId");
		
        return $dataProvider;
    }

    protected function getFulltextCondition($modelClass) {
    
        if (isset($_GET['filters'])) {
            $filters = json_decode($_GET['filters'], true);
            if (isset($filters['paid'])) {
                $paid = $filters['paid'];
                unset($filters['paid']);
                $_GET['filters'] = json_encode($filters);
            }
        }

        $andWhere = '('.parent::getFulltextCondition($modelClass);

        if (isset($_GET['fulltext'])) {
            $fulltext = $_GET['fulltext'];
            if(isset($_GET['fulltext'])) {

                $andWhere .= " OR supplier.name LIKE '%{$fulltext}%'";
                $andWhere .= " OR supplier.surname LIKE '%{$fulltext}%'";
                $andWhere .= " OR supplier.companyName LIKE '%{$fulltext}%'";
                $andWhere .= " OR costCentre.name LIKE '%{$fulltext}%' ";
            }
        }
        $andWhere .=') ';

        if (isset($paid)) {
            if ($paid == 'true') {
                $andWhere .= 'AND IFNULL(paidAmount, 0) >= amountVat';
            }

            if ($paid == 'false') {
                $andWhere .= 'AND IFNULL(paidAmount, 0) < amountVat';
            }
        }


        return $andWhere;
    }

	public function actionIndex() {
    	
        $dataProvider = $this->prepareDataProvider('supplier');

        return $dataProvider;
    }

    public function actionMarkAsPaid() {
        $p = Yii::$app->getRequest()->getBodyParams();


        if (isset($p['list'])) foreach ($p['list'] as $n=>$invoiceAttributes) {
            $invoice = \common\models\InvoiceIn::findOne($invoiceAttributes['id']);

            $invoice->markAsPaid(date('Y-m-d'), $p['type']);

        }   
    }

    public function actionGetIban() {
        $bankAccountPrefix = isset($_GET['bankAccountPrefix']) ? $_GET['bankAccountPrefix'] : '000000';
        if (!$bankAccountPrefix) $bankAccountPrefix = '000000';

        $bankAccount = $_GET['bankAccount'];
        $bankAccountCode = $_GET['bankAccountCode'];

        $iban = \common\components\Helpers::getIbanFromBban($bankAccount, $bankAccountCode, $bankAccountPrefix);

        return array('iban'=>$iban);
    }


}
