<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	/** @var Todo\TaskRepository */
	private $taskRepository;
	private $zarizeniRepository;
	private $faze, $faze1, $faze2, $faze3, $global;

	protected function startup()
	{
	    parent::startup();

	    if (!$this->getUser()->isLoggedIn()) {
		    $this->redirect('Sign:in');
	    }

	    $this->taskRepository = $this->context->taskRepository;
	    $this->zarizeniRepository = $this->context->zarizeniRepository;
	    $this->faze = $this->context->data_fazeRepository;
	    $this->global = $this->context->data_globalRepository;

	    $this->template->faze1 = $this->faze->fazeAktualni(1);
	    $this->template->faze2 = $this->faze->fazeAktualni(2);
	    $this->template->faze3 = $this->faze->fazeAktualni(3);
	    $this->template->global = $this->global->globalAktualni(10);
	}

	/** @return Todo\TaskListControl */
	public function createComponentIncompleteTasks()
	{
	    return new Todo\TaskListControl($this->taskRepository->findIncomplete(), $this->taskRepository);
	}

	public function createComponentZarizeni()
	{
	    return new Todo\ZarizeniControl($this->zarizeniRepository->getZarizeni(), $this->zarizeniRepository);
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
