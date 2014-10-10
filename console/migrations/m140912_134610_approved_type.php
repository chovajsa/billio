<?php

use yii\db\Schema;
use yii\db\Migration;

class m140912_134610_approved_type extends Migration
{
    public function up()
    {
    	$this->addColumn('approved', 'weight', 'tinyint(2) NOT NULL');
    }

    public function down()
    {
        echo "m140912_134610_approved_type cannot be reverted.\n";

        return false;
    }
}
