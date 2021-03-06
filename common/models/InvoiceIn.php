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
	
	public function getCostCentre() {
        return $this->hasOne(CostCentre::className(), ['id' => 'costCentreId']);
    }

    public function afterSave($insert, $changedAttributes) {
        if ($insert) {
        
        } else {
            // \common\components\Notifier::notifyUpdateInvoice($this);
        }

        return true;
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
        return ['supplierId', 'date', 'number', 'dueDate', 'referenceNumber', 'costCentreId', 'costPeriod', 'paidDate', 'ss', 'ks', 'paidAmount', 'paymentType'];
    }

    public function isApprovedBy() {
        return \common\models\Approved::findAll(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id]);
    }

    public function isApproved() {
        $w1 = \common\models\Approved::findOne(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id, 'weight'=>1]);
        $w2 = \common\models\Approved::findOne(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id, 'weight'=>2]);
        $w3 = \common\models\Approved::find()->where(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id, 'weight'=>2])->count();

        $d1 = \common\models\Declined::find()->where(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id])->count();

        if ($d1) return false;

        return ($w1 && $w2) || $w3 == 2;
    }   

    public function isDeclinedBy() {
        return \common\models\Declined::findAll(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id]);
    }

    public function isDeclined() {
        return !!$this->isDeclinedBy();
    }

    public function decline() {
        $weight = 0;

        if (Yii::$app->user->identity->canDo('admin')) $weight = 2;
        if (Yii::$app->user->identity->canDo('strongApprove')) $weight = 2;
        if (Yii::$app->user->identity->canDo('lightApprove')) $weight = 1;

        if (!$weight) {
            throw new \yii\web\ForbiddenHttpException('Not allowed');
        }

        $declined = \common\models\Declined::findOne(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id, 'userName'=>Yii::$app->user->identity->username]);

        if (!$declined) {
            $declined = new \common\models\Declined;
            $declined->model = \common\components\Helpers::get_real_class($this);
            $declined->modelId = $this->id;
            $declined->userName = Yii::$app->user->identity->username;
            $declined->weight = $weight;
         
            \common\components\Notifier::notifyDeclined($this);

            $declined->save();
        }

        $approved = \common\models\Approved::findOne(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id, 'userName'=>Yii::$app->user->identity->username]);
        if ($approved) $approved->delete();

        return true;
    }

    public function approve() {
        
        $weight = 0;

        if (Yii::$app->user->identity->canDo('admin')) $weight = 2;
        if (Yii::$app->user->identity->canDo('strongApprove')) $weight = 2;
        if (Yii::$app->user->identity->canDo('lightApprove')) $weight = 1;

        if (!$weight) {
            throw new \yii\web\ForbiddenHttpException('Not allowed');
        }

        $approved = \common\models\Approved::findOne(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id, 'userName'=>Yii::$app->user->identity->username]);

        if (!$approved) {
            $approved = new \common\models\Approved;
            $approved->model = \common\components\Helpers::get_real_class($this);
            $approved->modelId = $this->id;
            $approved->userName = Yii::$app->user->identity->username;
            $approved->weight = $weight;
         
            \common\components\Notifier::notifyApproved($this);

            $approved->save();
        }

        $declined = \common\models\Declined::findOne(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id, 'userName'=>Yii::$app->user->identity->username]);
        if ($declined)
            $declined->delete();

        return true;
    }

    public function unapprove() {
        $approved = \common\models\Approved::findOne(['model'=>\common\components\Helpers::get_real_class($this), 'modelId'=>$this->id, 'userName'=>Yii::$app->user->identity->username]);
        if ($approved) return $approved->delete(); 
        return false;
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

    public static function getFulltextAttributes() {
        return array('number', 'referenceNumber');
    }

    public function toArray(array $fields = [], array $expand = [], $recursive = true) {
        $return = $this->attributes;

        $return['supplier'] = $this->supplier instanceof Supplier ? $this->supplier->attributes : [];
        $return['supplier']['address'] = $this->supplier && $this->supplier->address ? $this->supplier->address->attributes : [];
        $return['supplier']['bankAccounts'] = [];

        $return['approved'] = $this->isApproved();
        $return['approvedBy'] = $this->isApprovedBy();
		
        $return['declined'] = $this->isDeclined();
        $return['declinedBy'] = $this->isDeclinedBy();
        
        
        $return['paid'] = $this->isPaid();

        $return['overdue'] = !$this->isPaid() && strtotime($this->dueDate) < time();
        
		//$return['costCentreName'] = $this->costCentre->name;
		$return['costCentre'] = ($this->costCentre instanceof CostCentre) ? $this->costCentre : [];

        if ($this->supplier && $this->supplier->bankAccounts) {
            foreach ($this->supplier->bankAccounts as $ba) {
                $return['supplier']['bankAccounts'][] = $ba->toArray();
            }
        }

        if (!$this->ks) $return['ks'] = '0308';

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

    public function isPaid() {
        return $this->paidAmount >= $this->amountVat;
    }

    public function markAsPaid($date, $type = 'B') {
        $this->paidAmount = $this->amountVat;
        $this->paidDate = $date;
        $this->paidUser = $date;
        $this->paymentType = $type;

        \common\components\Notifier::notifyPaid($this);

        return $this->save(false);
    }
   
}
