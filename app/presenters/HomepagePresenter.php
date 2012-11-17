<?php

use Nette\Diagnostics\Debugger;
use Nette\Application\UI\Form;

Debugger::enable(Debugger::DEVELOPMENT); // aktivujeme Laděnku

class HomepagePresenter extends BasePresenter {

    private $zarizeniRepository;
    private $c1Repository;
    private $data_fazeRepository;
    private $data_globalRepository;
    private $data_chybyRepository;
    private $id_zarizeni = 0;

    /** @persistent */
    public $menu;

    protected function startup() {
	parent::startup();

	if (!$this->getUser()->isLoggedIn()) {
	    $this->redirect('Sign:in');
	}

	$this->zarizeniRepository = $this->context->zarizeniRepository;
	$this->c1Repository = $this->context->zarizeniRepository;
	$this->data_fazeRepository = $this->context->data_fazeRepository;
	$this->data_globalRepository = $this->context->data_globalRepository;
	$this->data_chybyRepository = $this->context->data_chybyRepository;
    }

    public function renderDefault($id) {
	//$this->id_zarizeni = $id;
    }

    public function renderDetail($id = 0) {
	$this->id_zarizeni = $id;
	$this->template->menu = $this->menu;
    }

    function handleChangeFoo1() {
	if ($this->isAjax()) {
	    //$this->invalidateControl("pokus");
	}
    }

    function handleChangeFoo2() {
	if ($this->isAjax()) {
	    $this->invalidateControl("pokus");
	}
    }

    public function createComponentZarizeni() {
	return new Todo\ZarizeniControl($this->zarizeniRepository->getZarizeni(), $this->zarizeniRepository);
    }

    public function createComponentZarizeniHodnoty() {
	return new Todo\ZarizeniHodnotyControl($this->zarizeniRepository->FindById($this->id_zarizeni), $this->data_fazeRepository, $this->data_globalRepository);
    }

    public function createComponentZarizeniAlarmy() {
	return new Todo\ZarizeniAlarmyControl($this->data_chybyRepository, $this->id_zarizeni);
    }

    public function createComponentZarizeniEditace() {
	$zarizeni = $this->zarizeniRepository->findById($this->id_zarizeni);
	$form = new Form();
	$form->addText('nazev', 'Název:', 40, 100)
		->addRule(Form::FILLED, 'Je nutné zadat název zařízení.');
	$form->addText('telefon', 'Telefonní číslo:', 40, 100)
		->addRule(Form::FILLED, 'Je nutné zadat telefonní číslo zařízení.');
	$form->addText('ip', 'IP adresa:', 40, 100)
		->addRule(Form::FILLED, 'Je nutné zadat IP adresu zařízení.');
	$form->addHidden('id');
	$form->addSubmit('create', 'Uložit');
	$form->setDefaults(array(
	    'id' => $this->id_zarizeni, 
	    'nazev' => $zarizeni['nazev'], 
	    'telefon' => $zarizeni['telefon'], 
	    'ip' => $zarizeni['ip'])
	);
	$form->onSuccess[] = $this->EditaceFormSubmitted;
	return $form;
    }

    public function EditaceFormSubmitted(Form $form) {
		//die(sprintf('%s', $this->id_zarizeni));
	$this->zarizeniRepository->updateZarizeni($form->values->id, $form->values->nazev, $form->values->telefon, $form->values->ip);
	$this->flashMessage('Editace zařízení.', 'success');
	$this->redirect('this');
    }

    public function createComponentZarizeniGrafy() {
	return new Todo\ZarizeniGrafyControl($this->zarizeniRepository->FindById($this->id_zarizeni), $this->data_fazeRepository, $this->data_globalRepository);
    }

    protected function createComponentC1() {
	return new Todo\C1Control($this->zarizeniRepository->getZarizeni());
    }

    protected function createComponentC2() {
	return new Todo\C2Control(10);
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
