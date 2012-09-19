<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	/** @var Todo\TaskTable */
	private $tasks;



	protected function startup()
	{
		parent::startup();

		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect('Sign:in');
		}

		$this->tasks = $this->context->tasks;
	}



	/** @return Todo\TaskListControl */
	public function createComponentIncompleteTasks()
	{
		return new Todo\TaskListControl($this->tasks->findIncomplete(), $this->tasks);
	}



	/** @return Todo\TaskListControl */
	public function createComponentUserTasks()
	{
		$incomplete = $this->tasks->findIncompleteByUser($this->getUser()->getId());
		$control = new Todo\TaskListControl($incomplete, $this->tasks);
		$control->displayTaskList = TRUE;
		$control->displayUser = FALSE;
		return $control;
	}

}
