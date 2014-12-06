<?php

use yii\db\Schema;

class m140520_150300_basics extends \yii\db\Migration
{
    public function up()
    {

    	$this->createTable('address', [
            'id' => 'pk',
            'name' => Schema::TYPE_STRING . ' NULL',
        	'surname' => Schema::TYPE_STRING . ' NULL',
        	'street' => Schema::TYPE_STRING . ' NULL',
        	'city' => Schema::TYPE_STRING . ' NULL',
        	'zip' => Schema::TYPE_STRING . ' NULL',
        	'otherStreet' => Schema::TYPE_STRING . ' NULL',
        	'otherCity' => Schema::TYPE_STRING . ' NULL',
        	'otherZip' => Schema::TYPE_STRING . ' NULL',
        ]);

    	$this->createTable('supplier', [
            'id' => 'pk',
			'addressId' => 'BIGINT NULL',
        ]);

    	$this->createTable('invoiceIn', [
            'id' => 'pk',
            'supplierId' => 'BIGINT NULL', 
            'subjectId' => 'BIGINT NULL',
            'createdDate' => 'DATE',
            'dueDate' => 'date',
            'createdBy' => 'int(11)',
            'currency' => 'varchar(4)',

            'amount' => 'DECIMAL(10,2) NULL',
            'vat' => 'DECIMAL(10,2) NULL',
        ]);

    	$this->createTable('invoiceInRow', [
            'id' => 'pk',
            'invoiceInId' => 'BIGINT NOT NULL',
            'description' => 'VARCHAR(255) NULL',
            'amount' => 'DECIMAL(10,2) NULL',
            'vat' => 'DECIMAL(10,2) NULL',
        ]);

    	$this->createTable('subject', [
            'id' => 'pk',
            'addressId' => 'BIGINT NOT NULL'
        ]);

    }

    public function down()
    {
        echo "m140520_150300_basics cannot be reverted.\n";

        return false;
    }
}
