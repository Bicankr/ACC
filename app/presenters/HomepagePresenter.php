<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	private $zarizeniRepository;
	private $data_fazeRepository;
	private $data_globalRepository;

	protected function startup()
	{
	    parent::startup();

	    if (!$this->getUser()->isLoggedIn()) {
		    $this->redirect('Sign:in');
	    }

	    $this->zarizeniRepository = $this->context->zarizeniRepository;
	    $this->data_fazeRepository = $this->context->data_fazeRepository;
	    $this->data_globalRepository = $this->context->data_globalRepository;

	}

	/** @return Todo\TaskListControl */

	public function createComponentZarizeni()
	{
	    return new Todo\ZarizeniControl($this->zarizeniRepository->getZarizeni(), $this->zarizeniRepository);
	}

	public function createComponentZarizeniHodnoty()
	{
	    return new Todo\ZarizeniHodnotyControl($this->data_fazeRepository, $this->data_globalRepository);
	}

}
