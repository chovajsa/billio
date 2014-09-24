<?php

use yii\db\Schema;
use yii\db\Migration;

class m140924_133309_dropcols extends Migration
{
    public function up()
    {
    	$this->dropColumn('address', 'otherStreet');
    	$this->dropColumn('address', 'otherCity');
    	$this->dropColumn('address', 'otherZip');	
    }

    public function down()
    {
        echo "m140924_133309_dropcols cannot be reverted.\n";

        return false;
    }
}
