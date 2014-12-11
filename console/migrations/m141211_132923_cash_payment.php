<?php

use yii\db\Schema;
use yii\db\Migration;

class m141211_132923_cash_payment extends Migration
{
    public function up()
    {
    	$this->addColumn('invoiceIn', 'paymentType', 'varchar(2) NULL');
    	$this->update('invoiceIn', array('paymentType'=>'B'), 'paidAmount > 0');
    }

    public function down()
    {
        echo "m141211_132923_cash_payment cannot be reverted.\n";

        return false;
    }
}
