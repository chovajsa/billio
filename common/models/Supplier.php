<?php
namespace common\models;

use yii\base\NotSupportedException;
use common\models\AppActiveRecord;
/**
 * Supplier model
 *
 */
class Supplier extends AppActiveRecord
{

    public static function getFulltextAttributes() {
        return ['name'];
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

   public function toArray(array $fields = [], array $expand = [], $recursive = true) {
        $return = $this->attributes;
        
        $return ['address'] = $this->address->attributes;
        return $return;
    }

}
