<?php 

namespace frontend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;



class SupplierController extends ActiveController
{
    public $modelClass = 'common\models\Supplier';

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
            // 'create' => [
            //     'class' => 'yii\rest\CreateAction',
            //     'modelClass' => $this->modelClass,
            //     'checkAccess' => [$this, 'checkAccess'],
            //     'scenario' => $this->createScenario,
            // ],
            'update' => [
                'class' => 'yii\rest\UpdateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->updateScenario,
            ],
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
        $address->load($p, '');
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

    public function actionIndex() {
    	$modelClass = $this->modelClass;

    	$dataProvider = new ActiveDataProvider([
            'query' => $modelClass::find()->with('address'),
        ]);

        $models = $dataProvider->getModels();

        $r = [];
        foreach($models as $model) {
        	$tmp = $model->attributes;
        	$tmp['address'] = $model->address->attributes;
        	$r[] = $tmp;
        }

        return $r;
    }

}