<?php

use yii\db\Schema;
use yii\db\Migration;

class m140916_125041_bankAccounts extends Migration
{
    public function up()
    {

    	$this->createTable('bankAccount', [
    		'id' => 'pk',
    		'bankAccount'=>'varchar(15) not null',
    		'bankAccountCode'=>'varchar(4) not null',
    		'supplierId' => 'int null'
		]);

    }

    public function down()
    {
        echo "m140916_125041_bankAccounts cannot be reverted.\n";

        return false;
    }
}
