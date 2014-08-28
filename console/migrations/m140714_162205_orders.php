<?php

use yii\db\Schema;
use yii\db\Migration;

class m140714_162205_orders extends Migration
{
    public function up()
    {
    	$this->execute("
			CREATE TABLE `orderIn` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `supplierId` bigint(20) DEFAULT NULL,
			  `subjectId` bigint(20) DEFAULT NULL,
			  `createdDate` datetime DEFAULT NULL,
			  `date` date DEFAULT NULL,
			  `dueDate` date DEFAULT NULL,
			  `createdBy` int(11) DEFAULT NULL,
			  `currency` varchar(4) DEFAULT NULL,
			  `amount` decimal(10,2) DEFAULT NULL,
			  `amountVat` decimal(10,2) DEFAULT NULL,
			  `vat` decimal(10,2) DEFAULT NULL,
			  `referenceNumber` bigint(20) DEFAULT NULL,
			  `number` bigint(20) DEFAULT NULL,
			  `paidAmount` decimal(10,2) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;

		");

		$this->execute("
			CREATE TABLE `orderInRow` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `orderInId` bigint(20) NOT NULL,
			  `description` varchar(255) DEFAULT NULL,
			  `amount` decimal(10,2) DEFAULT NULL,
			  `pcs` int(4) DEFAULT NULL,
			  `vat` decimal(10,2) DEFAULT NULL,
			  `amountTotal` decimal(10,2) DEFAULT NULL,
			  `amountTotalVat` decimal(10,2) DEFAULT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		");
    }

    public function down()
    {
        echo "m140714_162205_orders cannot be reverted.\n";

        return false;
    }
}
