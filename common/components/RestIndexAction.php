<?php

namespace yii\rest;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * @author Miroslav Kanovsky
 */
class RestIndexAction extends IndexAction
{
	/**
     * Prepares the data provider that should return the requested collection of the models.
     * @return ActiveDataProvider
     */
    protected function prepareDataProvider()
    {
       	$modelClass = $this->modelClass;

        $orderBy='id';
        if (isset($_GET['orderBy'])) $orderBy=$_GET['orderBy'];

        $orderByDir='DESC';
        if (isset($_GET['orderByDir'])) $orderByDir=$_GET['orderByDir'];

        $limit=20;
        if (isset($_GET['limit'])) $limit=$_GET['limit'];

        $order = "$orderBy $orderByDir";

    	$dataProvider = new ActiveDataProvider([
            'query' => $modelClass::find()->limit($limit)->with('supplier')->orderBy($order),
            'pagination' => [
                'pageSize' => $limit,
            ],
        ]);

    	return $dataProvider;
    }
}