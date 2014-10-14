<?php

use yii\db\Schema;
use yii\db\Migration;

class m141007_145330_costPeriod extends Migration
{
    public function up()
    {
		$this->addColumn('invoiceIn', 'costPeriod', 'varchar(20)');
    }

    public function down()
    {
        echo "m141007_145330_costPeriod cannot be reverted.\n";

        return false;
    }
}
