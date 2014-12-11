<?php

use yii\db\Schema;
use yii\db\Migration;

class m140917_121143_supplier extends Migration
{
    public function up()
    {
    	$this->addColumn('supplier', 'companyName', 'varchar(120) NULL');
		$this->addColumn('supplier', 'name', 'varchar(120) NULL');
		$this->addColumn('supplier', 'surname', 'varchar(120) NULL');
		$this->addColumn('supplier', 'vat', 'int(2) DEFAULT 0');
    }

    public function down()
    {
        echo "m140917_121143_supplier cannot be reverted.\n";

        return false;
    }
}
