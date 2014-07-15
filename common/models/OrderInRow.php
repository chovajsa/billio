<?php
namespace common\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

/**
 * Supplier model
 *
 */
class OrderInRow extends ActiveRecord
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
        return 'orderInRow';
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
        return ['description', 'amount', 'pcs', 'vat', 'amountTotal', 'amountTotalVat', 'orderInId'];
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

   
}
