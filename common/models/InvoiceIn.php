<?php
namespace common\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;


/**
 * Supplier model
 *
 */
class InvoiceIn extends ActiveRecord
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
        return 'invoiceIn';
    }

    public function getSupplier() {
        return $this->hasOne(Supplier::className(), ['id' => 'supplierId']);
    }

    public function getRows() {
        return $this->hasMany(InvoiceInRow::className(), ['invoiceInId' => 'id']);   
    }

    /**
      * @inheritdoc
      */
     public function rules()
     {
         return [
            [$this->safeAttributes(), 'safe'],
            [['supplierId'], 'number'],
         ];
     }


     public function safeAttributes() {
        return ['supplierId', 'date', 'number', 'dueDate', 'referenceNumber'];
     }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

   
}
