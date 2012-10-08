<?php
namespace Todo;
use Nette;

class ZarizeniControl extends Nette\Application\UI\Control
{
	/** @var boolean */
	public $displayUser = TRUE;

	/** @var boolean */
	public $displayList = FALSE;

	/** @var Nette\Database\Table\Selection */
	private $selected;

	/** @var TaskRepository */
	private $taskRepository;

	public function __construct(Nette\Database\Table\Selection $selected, ZarizeniRepository $taskRepository)
	{
		parent::__construct(); // vždy je potřeba volat rodičovský konstruktor
		$this->selected = $selected;
		$this->taskRepository = $taskRepository;
	}

	public function handleMarkDone($taskId)
	{
		$this->taskRepository->markDone($taskId);
		if (!$this->presenter->isAjax()) {
		$this->presenter->redirect('this');
	}

		$this->invalidateControl();
	}

	public function render()
	{
		$this->template->setFile(__DIR__ . '/Zarizeni.latte');
		$this->template->zarizeni = $this->selected;
		$this->template->displayUser = $this->displayUser;
		$this->template->displayList = $this->displayList;
		$this->template->render();
	}
}
