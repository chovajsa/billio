<?php

use yii\db\Schema;
use yii\db\Migration;

class m141010_121509_paidDate extends Migration
{
    public function up()
    {
    	$this->addColumn('invoiceIn', 'paidDate', 'date NULL');
    }

    public function down()
    {
        echo "m141010_121509_paidDate cannot be reverted.\n";

        return false;
    }
}
