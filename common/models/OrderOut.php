<?php
namespace common\models;

use yii\base\NotSupportedException;
use common\models\AppActiveRecord;


/**
 * Invoice In model
 *
 */
class OrderOut extends \common\models\InvoiceIn
{

    public static function tableName() {
        return 'orderOut';
    }


    public function getRows() {
        return $this->hasMany(OrderOutRow::className(), ['orderOutId' => 'id']);   
    }
   
}
