<?php
namespace Todo;

use Nette;

class Data_chybyRepository extends Repository
{
	/** @var string */
	protected $tableName = 'data_chyby';

	/**
	 * @return Nette\Database\Table\Selection
	 */
	public function tasksOf(Nette\Database\Table\ActiveRow $list)
	{
		return $list->related('task')->order('created');
	}


	public function findAllByDatum()
	{ 
		return $this->getTable()->order('datum DESC');
	}

}
