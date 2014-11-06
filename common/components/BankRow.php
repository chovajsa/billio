<?php 

namespace common\components;


class BankRow {

	public $currency = 'EUR';
	public $amount, $vs, $date, $dueDate, $bankAccount, $bankAccountPrefix, $bankAccountCode, $name;
	public $ks = '0308';
	public $ss = 0;
	public $note1 = '';
	public $note2 = '';
	public $note3 = '';
	public $note4 = '';

	public function getArray() {
		return array(
			$this->currency,
			$this->amount,
			'4150047806',
			$this->date,
			$this->dueDate,
			$this->bankAccount,
			$this->bankAccountPrefix,
			$this->bankAccountCode,
			$this->name,
			$this->ks,
			$this->vs,
			$this->ss,
			1,
			$this->note1,
			$this->note2,
			$this->note3,
			$this->note4
		);
	}
}