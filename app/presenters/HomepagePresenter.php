<?php

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter {

    private $zarizeniRepository;
    private $data_fazeRepository;
    private $data_globalRepository;
    private $id_zarizeni = 0;
    private $foo;
    private $menu;

    protected function startup() {
	parent::startup();

	if (!$this->getUser()->isLoggedIn()) {
	    $this->redirect('Sign:in');
	}

	$this->zarizeniRepository = $this->context->zarizeniRepository;
	$this->data_fazeRepository = $this->context->data_fazeRepository;
	$this->data_globalRepository = $this->context->data_globalRepository;
	$this->foo = 'startup';
    }

    public function renderDefault($id = 0) {
	$this->template->foo = $this->foo;
    }

    public function renderDetail($id = 0) {
	$this->id_zarizeni = $id;
	$this->template->menu = $this->menu;
    }

    public function createComponentZarizeni() {
	return new Todo\ZarizeniControl($this->zarizeniRepository->getZarizeni(), $this->zarizeniRepository);
    }

    public function createComponentZarizeniHodnoty() {
	return new Todo\ZarizeniHodnotyControl($this->zarizeniRepository->FindById($this->id_zarizeni), $this->data_fazeRepository, $this->data_globalRepository);
    }

    public function handleclose() {
	$this->presenter->redirect('default');
    }

    public function handlemenu($val = '') {
	if ($val == 'Zpět')
	    $this->presenter->redirect('default');
	$this->menu = $val;
    }

}
