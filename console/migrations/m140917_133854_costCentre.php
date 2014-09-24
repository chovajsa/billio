<?php

use yii\db\Schema;
use yii\db\Migration;

class m140917_133854_costCentre extends Migration
{
    public function up()
    {

    	$this->createTable('costCentre', [
    		'id' => 'pk',
    		'name'=>'varchar(15) not null',
		]);
		
		$this->addColumn('invoiceIn', 'costCentreId', 'int(11)');
		
		$this->insert('costCentre',array('name'=>'marketing'));
		$this->insert('costCentre',array('name'=>'IT'));

    }

    public function down()
    {
        echo "m140917_133854_costCentre cannot be reverted.\n";

        return false;
    }
}
