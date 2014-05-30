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
            
            'view' => [
                'class' => 'yii\rest\ViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'create' => [
                'class' => 'yii\rest\CreateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->createScenario,
            ],
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
	public function actionIndex() {
    	$modelClass = $this->modelClass;

    	$dataProvider = new ActiveDataProvider([
            'query' => $modelClass::find()->with('supplier')->orderBy('id DESC')
        ]);

        $models = $dataProvider->getModels();

        $r = [];
        foreach($models as $model) {
        	$tmp = $model->attributes;
        	$tmp['supplier'] = $model->supplier ? $model->supplier->attributes : [];
            $tmp['supplier']['address'] = $model->supplier->address ? $model->supplier->address->attributes : [];
            
        	$r[] = $tmp;
        }

        return $r;
    }

}