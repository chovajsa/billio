<?php
namespace common\models;

use yii\base\NotSupportedException;
use common\models\AppActiveRecord;
use Yii;
/**
 * Invoice In model
 *
 */
class InvoiceIn extends AppActiveRecord
{

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

    public function isApprovedBy() {
       return \common\models\Approved::findAll(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id]);
    }

    public function isApproved() {
        return !!$this->isApprovedBy();
    }

    public function approve() {
        $approved = new \common\models\Approved;
        $approved->model = \common\components\Helpers::get_real_class($this);
        $approved->modelId = $this->id;
        $approved->userName = Yii::$app->user->identity->username;
        return $approved->save();
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

        $return['approved'] = $this->isApproved();
        $return['approvedBy'] = $this->isApprovedBy();

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
