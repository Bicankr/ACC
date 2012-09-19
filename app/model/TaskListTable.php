<?php

namespace Todo;

use Nette;



class TaskListTable extends Table
{

	/** @var string */
	protected $tableName = 'tasklist';



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
