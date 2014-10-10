<?php
namespace common\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use Yii;

/**
 * Supplier model
 *
 */
class Settings extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    public static function tableName() {
        return 'settings';
    }

    public static function getFileStoragePath() {
		return Yii::$app->params['fileStoragePath'];
    }

    /**
      * @inheritdoc
      */
     public function rules()
     {
         return [
         ];
     }


     public function safeAttributes() {
        return [];
     }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

   
}
