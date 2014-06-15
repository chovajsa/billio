<?php 

namespace frontend\modules\api\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;


class ActiveRestController extends ActiveController {

    protected function prepareDataProvider($with = []) {
       	$modelClass = $this->modelClass;

        $orderBy='id';
        if (isset($_GET['orderBy'])) $orderBy=$_GET['orderBy'];

        $orderByDir='DESC';
        if (isset($_GET['orderByDir'])) $orderByDir=$_GET['orderByDir'];

        $limit=20;
        if (isset($_GET['limit'])) $limit=$_GET['limit'];

        $order = "$orderBy $orderByDir";

    	$dataProvider = new ActiveDataProvider([
            'query' => $modelClass::find()->limit($limit)->with($with)->orderBy($order),
            'pagination' => [
                'pageSize' => $limit,
            ],
        ]);

    	return $dataProvider;
    }

}
?>