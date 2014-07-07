<?php 

namespace frontend\modules\api\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;


class ActiveRestController extends ActiveController {

    protected function prepareDataProvider($with = []) {
       	

        $modelClass = $this->modelClass;

        $orderBy='id';
        if (isset($_GET['sort'])) $orderBy=$_GET['sort'];

        $orderByDir='DESC';
        if (isset($_GET['direction'])) $orderByDir=$_GET['direction'];

        $limit=20;
        if (isset($_GET['limit'])) $limit=$_GET['limit'];

        $order = "$orderBy $orderByDir";

        $dataProvider = new ActiveDataProvider([
            'query' => $modelClass::find()->limit($limit)->with($with)->orderBy($order),
            'sort'=>['attributes'=>[$order]],
            'pagination' => [
                'pageSize' => $limit,
            ],
        ]);

        if (isset($_GET['filters'])) {
            $filters = json_decode($_GET['filters']);
            if (!empty($filters)) {
                foreach ($filters as $key=>$value) {
                    $dataProvider->query->andWhere($key. " = '{$value}'");
                }
            }
        }
        
        return $dataProvider;
    }

}
?>