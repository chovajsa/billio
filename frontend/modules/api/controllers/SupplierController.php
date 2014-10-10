<?php 

namespace frontend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;



class SupplierController extends ActiveRestController
{
    public $modelClass = 'common\models\Supplier';

	/**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
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

    public function actionCreate() {
        /**
         * @var \yii\db\ActiveRecord $model
         */
        $supplier = new \common\models\Supplier;

        $p = Yii::$app->getRequest()->getBodyParams();

        $supplier->load($p, '');

        $address = new \common\models\Address;
        $address->load($p['address'], '');
        $address->save();
        $supplier->addressId = $address->id;

        if ($supplier->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($supplier->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        }

        return $supplier;
    }

    public function actionUpdate($id) {
        $supplier = \common\models\Supplier::findOne($id);
        return $this->update($supplier);
    }

    public function update($supplier) {
        $p = Yii::$app->getRequest()->getBodyParams();
        
        $supplier->load($p, '');
        $supplier->save();

        if (!($address = $supplier->address)) {
            $address = new \common\models\Address;
            $address->save();
            $supplier->addressId = $address->id;
            $supplier->save();
        }

/*  8==========================================================D   */

        if (isset($p['bankAccounts']) && !empty($p['bankAccounts'])) {
            foreach ($p['bankAccounts'] as $prow) {
                if (!isset($prow['id']) || !$prow['id']) {
                    $row = new \common\models\BankAccount();
                    $row->supplierId = $supplier->id;
                    $row->setAttributes($prow, '');
                    $row->save();
                } else 

                foreach ($supplier->bankAccounts as $row) {
                    if ($prow['id'] == $row->id) {
                        $row->setAttributes($prow, '');
                        $row->save();
                    }
                }
            }
        }

        if (!empty($p['toDelete'])) {
            foreach ($p['toDelete'] as $x) {
                $r = \common\models\BankAccount::findOne($x['id']);
                $r->delete();
            }
        }
/*  8==========================================================D   */
    
        // print_r($p);
        // print_r($address->attributes);

        $address->load($p['address'], '');
        $address->save();

        return $supplier;
    }

    public function actionIndex() {
        return $dataProvider = $this->prepareDataProvider();
    }

    protected function getFulltextCondition($modelClass) {
        $andWhere = '';
        
        if (isset($_GET['fulltext'])) {
            $fulltext = $_GET['fulltext'];
            $andWhere = "supplier.name LIKE '%$fulltext%' OR supplier.surname LIKE '%$fulltext%' OR supplier.companyName LIKE '%$fulltext%'";    
        }

        return $andWhere;
    }

}