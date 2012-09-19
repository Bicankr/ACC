<?php

namespace Todo;

use Nette;



class TaskListControl extends Nette\Application\UI\Control
{

	/** @var boolean */
	public $displayUser = TRUE;

	/** @var boolean */
	public $displayTaskList = FALSE;

	/** @var Nette\Database\Table\Selection */
	private $selected;

	/** @var TaskTable */
	private $tasks;



	public function __construct(Nette\Database\Table\Selection $selected, TaskTable $tasks)
	{
		parent::__construct(); // vždy je potřeba volat rodičovský konstruktor
		$this->selected = $selected;
		$this->tasks = $tasks;
	}



	public function handleMarkDone($taskId)
	{
		$this->tasks->markDone($taskId);
		if (!$this->presenter->isAjax()) {
			$this->presenter->redirect('this');
		}

		$this->invalidateControl();
	}



	public function render()
	{
		$this->template->setFile(__DIR__ . '/TaskList.latte');
		$this->template->tasks = $this->selected;
		$this->template->displayUser = $this->displayUser;
		$this->template->displayTaskList = $this->displayTaskList;
		$this->template->render();
	}

}
