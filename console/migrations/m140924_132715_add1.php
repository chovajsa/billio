<?php

use yii\db\Schema;
use yii\db\Migration;

class m140924_132715_add1 extends Migration
{
    public function up()
    {
    	$this->addColumn('address', 'street1', 'varchar(255)');
    	$this->addColumn('address', 'city1', 'varchar(255)');
    	$this->addColumn('address', 'zip1', 'varchar(255)');
    }

    public function down()
    {
        echo "m140924_132715_add1 cannot be reverted.\n";

        return false;
    }
}
