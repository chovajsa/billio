<?php
namespace common\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

/**
 * Supplier model
 *
 */
class Supplier extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
      * @inheritdoc
      */
     public function rules()
     {
         return [
         ];
     }

    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'addressId']);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

   
}
