<?php

use Nette\Application\UI\Form;



/**
 * Presenter, který zajišťuje výpis seznamů úkolů.
 *
 * @property callable $taskFormSubmitted
 */
class TaskPresenter extends BasePresenter
{

	/** @var Todo\ListRepository */
	private $listRepository;

	/** @var Todo\TaskRepository */
	private $taskRepository;

	/** @var Todo\UserRepository */
	private $userRepository;

	/** @var Nette\Database\Table\ActiveRow */
	private $list;

	protected function startup()
	{
		parent::startup();

		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect('Sign:in');
		}

		$this->listRepository = $this->context->listRepository;
		$this->taskRepository = $this->context->taskRepository;
		$this->userRepository = $this->context->userRepository;
	}

	public function actionDefault($id)
	{
		$this->list = $this->listRepository->find($id);
		if ($this->list === FALSE) {
			$this->setView('notFound');
		}
	}

	public function renderDefault()
	{
		$this->template->list = $this->list;
	}

	protected function createComponentZarizeni()
	{
		if ($this->list === NULL) {
			$this->error('Wrong action');
		}

		return new Todo\ZarizeniControl($this->listRepository->tasksOf($this->list), $this->taskRepository);
	}

	/**
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentTaskForm()
	{
		$userPairs = $this->userRepository->findAll()->fetchPairs('id', 'name');

		$form = new Form();
		$form->addText('text', 'Úkol:', 40, 100)
			->addRule(Form::FILLED, 'Je nutné zadat text úkolu.');
		$form->addSelect('userId', 'Pro:', $userPairs)
			->setPrompt('- Vyberte -')
			->addRule(Form::FILLED, 'Je nutné vybrat, komu je úkol přiřazen.')
			->setDefaultValue($this->getUser()->getId());

		$form->addSubmit('create', 'Vytvořit');
		$form->onSuccess[] = $this->taskFormSubmitted;

		return $form;
	}

	/**
	 * @param  Nette\Application\UI\Form $form
	 */
	public function taskFormSubmitted(Form $form)
	{
		$this->taskRepository->createTask($this->list->id, $form->values->text, $form->values->userId);
		$this->flashMessage('Úkol přidán.', 'success');
		if (!$this->isAjax()) {
			$this->redirect('this');
		}

		$form->setValues(array('userId' => $form->values->userId), TRUE);
		$this->invalidateControl('form');
		$this['taskList']->invalidateControl();
	}

}
