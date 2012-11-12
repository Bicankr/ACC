<?php
namespace Todo;

use Nette;

class Data_chybyRepository extends Repository
{
	/** @var string */
	protected $tableName = 'data_chyby';

	public function getAlarmy($regulator)
	{ 
		return $this->findBy(array('regulator' => $regulator))->order('datum')->limit(18);
	}

}
