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

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }


    public function getAttachments() {
        $entries = array();

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
   
}
