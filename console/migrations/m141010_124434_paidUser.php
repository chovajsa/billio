<?php

use yii\db\Schema;
use yii\db\Migration;

class m141010_124434_paidUser extends Migration
{
    public function up()
    {
		$this->addColumn('invoiceIn', 'paidUser', 'date NULL');
    }

    public function down()
    {
        echo "m141010_124434_paidUser cannot be reverted.\n";

        return false;
    }
}
