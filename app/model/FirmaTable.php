<?php

namespace Todo;

use Nette;



class FirmaTable extends Table
{

	/** @var string */
	protected $tableName = 'firma';



	/**
	 * @return Nette\Database\Table\Selection
	 */
	public function tasksOf(Nette\Database\Table\ActiveRow $taskList)
	{
		return $taskList->related('task')->order('created');
	}



	/**
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function createList($title)
	{
		return $this->getTable()->insert(array(
			'title' => $title
		));
	}

}
