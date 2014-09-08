<?php 

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\data\ActiveDataProvider;
use Yii;


class OrderOutController extends ActiveRestController
{
    public $modelClass = 'common\models\OrderOut';



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

    

    public function actionCreate() {
        $orderOut = new \common\models\OrderOut;
        $p = Yii::$app->getRequest()->getBodyParams();
        $orderOut->load($p, '');

        $orderOut->createdBy = Yii::$app->user->id;
        $orderOut->createdDate = date('Y-m-d H:i:s');
        
        $orderOut->save();
        return $this->update($orderOut);
    }

    public function actionUpdate($id) {
        $orderOut = \common\models\OrderOut::findOne($id);
        return $this->update($orderOut);
    }

    public function update($orderOut) {
        $p = Yii::$app->getRequest()->getBodyParams();
        
        $orderOut->load($p, '');
        $orderOut->save();

        if (isset($p['rows']) && !empty($p['rows'])) {
            foreach ($p['rows'] as $prow) {
                if (!isset($prow['id']) || !$prow['id']) {
                    $row = new \common\models\OrderOutRow();
                    $row->orderOutId = $orderOut->id;
                    $row->setAttributes($prow, '');

                    $row->amountTotal = $row->pcs * $row->amount;
                    $row->amountTotalVat = $row->amountTotal + $row->vat * $row->pcs;

                    $row->save();
                } else 
                foreach ($orderOut->rows as $row) {
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
                $r = \common\models\OrderOutRow::findOne($x['id']);
                $r->delete();
            }
        }

        $orderOut->refresh();
        $orderOut->amount = 0;
        $orderOut->amountVat = 0;
        $orderOut->vat = 0;

        //= amount  pcs vat amountTotal amountTotalVat
        // amount  decimal(10,2) NULL   
        // amountVat   decimal(10,2) NULL   
        // vat
        
        foreach ($orderOut->rows as $row) {
            $orderOut->amount += $row->amountTotal;
            $orderOut->amountVat += ($row->amountTotalVat);
            $orderOut->vat += $row->vat;
        } 

        $orderOut->save();

        return $orderOut;
    }


	public function actionIndex() {
    	
        $dataProvider = $this->prepareDataProvider('supplier');

        return $dataProvider;
    }

    public function actionApprove($id) {
        $invoiceIn = \common\models\OrderOut::findOne($id);
        $invoiceIn->approve();
    }


}