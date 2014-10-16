<?php

use yii\db\Schema;
use yii\db\Migration;

class m141015_140038_costc extends Migration
{
    public function up()
    {
    	$this->addColumn('costCentre', 'parent', 'varchar(100)');
    
    	$this->truncateTable('costCentre');


    $this->insert('costCentre', array('parent'=>'Direct cost', 'name'=> 'Scoring costs'));
	$this->insert('costCentre', array('parent'=>'Direct cost', 'name'=> 'Courier costs'));
	$this->insert('costCentre', array('parent'=>'Direct cost', 'name'=> 'Bank cost related to loanhandling'));
	$this->insert('costCentre', array('parent'=>'Direct cost', 'name'=> 'SMS gateway'));
	$this->insert('costCentre', array('parent'=>'Direct cost', 'name'=> 'Internet cost'));
	$this->insert('costCentre', array('parent'=>'Direct cost', 'name'=> 'Phone costs  '));
	$this->insert('costCentre', array('parent'=>'Direct cost', 'name'=> 'Invoicing cost (posting, envelopes)'));
	$this->insert('costCentre', array('parent'=>'Direct cost', 'name'=> 'Collecting costs'));
	$this->insert('costCentre', array('parent'=>'Direct cost', 'name'=> 'Other direct costs'));
	$this->insert('costCentre', array('parent'=>'Staff cost', 'name'=> 'Gastro vouchers'));
	$this->insert('costCentre', array('parent'=>'Staff cost', 'name'=> 'Training  & recruiting'));
	$this->insert('costCentre', array('parent'=>'Marketing & representation TOTAL', 'name'=>'Tv, radio, print'));
	$this->insert('costCentre', array('parent'=>'Marketing & representation TOTAL', 'name'=>'PPC'));
	$this->insert('costCentre', array('parent'=>'Marketing & representation TOTAL', 'name'=>'Media, others'));
	$this->insert('costCentre', array('parent'=>'Marketing & representation TOTAL', 'name'=>'Advertising (production costs)'));
	$this->insert('costCentre', array('parent'=>'Marketing & representation TOTAL', 'name'=>'Marketing costs - intercompany'));
	$this->insert('costCentre', array('parent'=>'Marketing & representation TOTAL', 'name'=>'Market research'));
	$this->insert('costCentre', array('parent'=>'Marketing & representation TOTAL', 'name'=>'Comissions to partners'));
	$this->insert('costCentre', array('parent'=>'Marketing & representation TOTAL', 'name'=>'Other marketing costs'));
	$this->insert('costCentre', array('parent'=>'Travel cost', 'name' => 'Daily allowances'));
	$this->insert('costCentre', array('parent'=>'Travel cost', 'name' => 'Tickets and hotels'));
	$this->insert('costCentre', array('parent'=>'Travel cost', 'name' => 'Car costs, parking and taxi-expenses'));
	$this->insert('costCentre', array('parent'=>'Travel cost', 'name' => 'Other travel costs'));
	$this->insert('costCentre', array('parent'=>'Professional fees', 'name' => 'Accounting & payroll'));
	$this->insert('costCentre', array('parent'=>'Professional fees', 'name' => 'Audit'));
	$this->insert('costCentre', array('parent'=>'Professional fees', 'name' => 'Consulting'));
	$this->insert('costCentre', array('parent'=>'Professional fees', 'name' => 'Legal'));
	$this->insert('costCentre', array('parent'=>'Machinery & Equipment', 'name' => 'Machinery & Equipment (small machinery purchases)'));
	$this->insert('costCentre', array('parent'=>'Machinery & Equipment', 'name' => 'Machinery & Equipment (lease)'));
	$this->insert('costCentre', array('parent'=>'Office cost', 'name' => 'Office rent'));
	$this->insert('costCentre', array('parent'=>'Office cost', 'name' => 'Maintenance costs'));
	$this->insert('costCentre', array('parent'=>'Office cost', 'name' => 'Other office costs'));
	$this->insert('costCentre', array('parent'=>'Other operation cost', 'name' => 'Office supplies'));
	$this->insert('costCentre', array('parent'=>'Other operation cost', 'name' => 'IT and computer services'));
	$this->insert('costCentre', array('parent'=>'Other operation cost', 'name' => 'Insurances'));
	$this->insert('costCentre', array('parent'=>'Other operation cost', 'name' => 'Other operation costs'));

    }

    public function down()
    {
        echo "m141015_140038_costc cannot be reverted.\n";

        return false;
    }
}
