<?php

use yii\db\Schema;
use yii\db\Migration;

class m141015_151903_prefixaiban extends Migration
{
    public function up()
    {
    	$this->addColumn('bankAccount', 'bankAccountPrefix', 'varchar(10) NULL');
    	$this->addColumn('bankAccount', 'iban', 'varchar(50) NULL');
    }

    public function down()
    {
        echo "m141015_151903_prefixaiban cannot be reverted.\n";

        return false;
    }
}
