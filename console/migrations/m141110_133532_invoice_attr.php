<?php

use yii\db\Schema;
use yii\db\Migration;

class m141110_133532_invoice_attr extends Migration
{
    public function up()
    {
		$this->addColumn('invoiceIn', 'ks', 'varchar(10) NULL');
		$this->addColumn('invoiceIn', 'ss', 'varchar(10) NULL');
    }

    public function down()
    {
        echo "m141110_133532_invoice_attr cannot be reverted.\n";

        return false;
    }
}
