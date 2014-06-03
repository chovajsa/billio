<?php 

namespace frontend\modules\api\controllers;

use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\data\ActiveDataProvider;
use Yii;


class InvoiceInController extends ActiveController
{
    public $modelClass = 'common\models\InvoiceIn';

    public function init() {

    	Yii::$app->request->parsers = [
        	'application/json' => 'yii\web\JsonParser',
    	];

    	return parent::init();
    }

	public function behaviors()
	{
	    $formats = parent::behaviors();
	    $formats['contentNegotiator']['formats'] = array('application/json'=>'json');

		return $formats;
	}

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
            
            // 'view' => [
                // 'class' => 'yii\rest\ViewAction',
                // 'modelClass' => $this->modelClass,
                // 'checkAccess' => [$this, 'checkAccess'],
            // ],
            'create' => [
                'class' => 'yii\rest\CreateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->createScenario,
            ],
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

    public function actionView($id) {
        $model = \common\models\InvoiceIn::findOne($id);

        $attributes =  $model->attributes;
        $rows = $model->rows;

        $rs = [];
        foreach ($rows as $r) {
            $rs[] = $r->attributes;
        }

        $attributes['rows'] = $rs;
        return $attributes;
    }

    public function actionUpdate($id) {
        $p = Yii::$app->getRequest()->getBodyParams();
        $invoiceIn = \common\models\InvoiceIn::findOne($id);
        $invoiceIn->load($p, '');
    
        $invoiceIn->save();

        if (isset($p['rows']) && !empty($p['rows'])) {
            foreach ($p['rows'] as $prow) {
                if (!isset($prow['id']) || !$prow['id']) {
                    $row = new \common\models\InvoiceInRow();
                    $row->invoiceInId = $invoiceIn->id;
                    $row->setAttributes($prow, '');
                    $row->save();
                } else 
                foreach ($invoiceIn->rows as $row) {
                    if ($prow['id'] == $row->id) {
                            $row->setAttributes($prow, '');
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
            $invoiceIn->amount += $row->amount;
            $invoiceIn->amountVat += $row->amountVat;
            $invoiceIn->vat += $row->vat;
        } 

        $invoiceIn->save();

        return $invoiceIn;
    }

	public function actionIndex() {
    	$modelClass = $this->modelClass;

    	$dataProvider = new ActiveDataProvider([
            'query' => $modelClass::find()->with('supplier')->orderBy('id DESC')
        ]);

        $models = $dataProvider->getModels();

        $r = [];
        foreach($models as $model) {
        	$tmp = $model->attributes;
        
        	$tmp['supplier'] = $model->supplier instanceof Supplier ? $model->supplier->attributes : [];
            $tmp['supplier']['address'] = $model->supplier && $model->supplier->address ? $model->supplier->address->attributes : [];
            
            $tmp['rows'] = $model->getRows();

        	$r[] = $tmp;
        }

        return $r;
    }

}