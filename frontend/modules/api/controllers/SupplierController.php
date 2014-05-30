<?php 

namespace frontend\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\data\ActiveDataProvider;


class SupplierController extends ActiveController
{
    public $modelClass = 'common\models\Supplier';


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