<?php
namespace common\models;

use yii\base\NotSupportedException;
use common\models\AppActiveRecord;


/**
 * Order In model
 *
 */
class OrderIn extends AppActiveRecord
{

    public static function tableName() {
        return 'orderIn';
    }

    public function getSupplier() {
        return $this->hasOne(Supplier::className(), ['id' => 'supplierId']);
    }


    public function getRows() {
        return $this->hasMany(OrderInRow::className(), ['orderInId' => 'id']);   
    }


    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
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


    public function getAttachments() {
        $entries = [];

        $folder = Settings::getFileStoragePath().'/'.$this->id;
        if (file_exists($folder))
        if ($handle = opendir($folder)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $entries[] = $entry;
                }
            }
            closedir($handle);
        }

        return $entries;
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true) {
        $return = $this->attributes;

        $return['supplier'] = $this->supplier instanceof Supplier ? $this->supplier->attributes : [];
        $return['supplier']['address'] = $this->supplier && $this->supplier->address ? $this->supplier->address->attributes : [];
        $rows = $this->getRows()->all();
        $return['rows'] = [];
        foreach ($rows as $row) {
          $return['rows'][] = $row->toArray();  
        }

        if ($user = $this->user) {
            $return['createdByUserName'] = $user->username;
        }
        
        return $return;
    }
   
}
