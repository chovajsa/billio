<?php

use yii\db\Schema;
use yii\db\Migration;

class m141120_101539_declined extends Migration
{
    public function up()
    {
    	$this->createTable('declined', [
			'id' =>'pk',
			'userName' =>'varchar(64) NOT NULL',
			'model' =>'varchar(64) NOT NULL',
			'modelId' =>'int(11) NOT NULL',
			'time' =>'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
			'weight' =>'tinyint(2) NOT NULL'
        ]);

    }

    public function down()
    {
        echo "m141120_101539_declined cannot be reverted.\n";

        return false;
    }
}
