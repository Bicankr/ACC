<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	/** @var Todo\TaskRepository */
	private $taskRepository;
	private $v1;

	protected function startup()
	{
		parent::startup();

		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect('Sign:in');
		}

		$this->taskRepository = $this->context->taskRepository;
		$this->v1 = $this->context->data_chybyRepository;
		$this->template->v1 = $this->v1->findall();
	}



	/** @return Todo\TaskListControl */
	public function createComponentIncompleteTasks()
	{
		return new Todo\TaskListControl($this->taskRepository->findIncomplete(), $this->taskRepository);
	}



	/** @return Todo\TaskListControl */
	public function createComponentUserTasks()
	{
		$incomplete = $this->taskRepository->findIncompleteByUser($this->getUser()->getId());
		$control = new Todo\TaskListControl($incomplete, $this->taskRepository);
		$control->displayList = TRUE;
		$control->displayUser = FALSE;
		return $control;
	}

}
