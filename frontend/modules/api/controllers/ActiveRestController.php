<?php 

namespace frontend\modules\api\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;


class ActiveRestController extends ActiveController {

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

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

    protected function prepareDataProvider($with = []) {
       	

        $modelClass = $this->modelClass;

        $orderBy='id';
        if (isset($_GET['sort']) && $_GET['sort'] !== 'false') $orderBy=$_GET['sort'];

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

        if ($andWhere = $this->getFulltextCondition($modelClass)) {
            $dataProvider->query->andWhere($andWhere);
        }        

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

    protected function getFulltextCondition($modelClass) {
        $andWhere = '';
        if (isset($_GET['fulltext']) && !empty($modelClass::getFulltextAttributes())) {
            $andWhere = '(';

            $fulltextAttributes = $modelClass::getFulltextAttributes();
            foreach ($fulltextAttributes as $n=>$attribute) {
                $andWhere .= "$attribute LIKE '%{$_GET['fulltext']}%'";

                if ($n+1 < count($fulltextAttributes)) $andWhere .= ' OR ';
            }

            $andWhere .= ')';
        }
        return $andWhere;
    }



}
?>