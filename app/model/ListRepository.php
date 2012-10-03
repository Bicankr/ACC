<?php

namespace Todo;

use Nette;



class ListRepository extends Repository
{

	/** @var string */
	protected $tableName = 'list';



	/**
	 * @return Nette\Database\Table\Selection
	 */
	public function tasksOf(Nette\Database\Table\ActiveRow $list)
	{
		return $list->related('task')->order('created');
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
