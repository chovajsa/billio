<?php
namespace common\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

/**
 * Supplier model
 *
 */
class CostCentre extends ActiveRecord
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
        return 'costCentre';
    }

    /**
      * @inheritdoc
      */
     public function rules()
     {
         return [
            [$this->safeAttributes(), 'safe'],
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
