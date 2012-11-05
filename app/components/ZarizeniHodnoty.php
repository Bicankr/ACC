<?php
namespace Todo;
use Nette;

class ZarizeniHodnotyControl extends Nette\Application\UI\Control
{
    private $zarizeni; 
    private $faze;
    private $global;
    /** @persistent int */
    public $id1 = 0;
    /** @persistent int */
    public $id2 = 0;
    /** @persistent int */
    public $id3 = 0;

    public function __construct($Zarizeni, $Data_fazeRepository, $Data_globalRepository)
    {
	parent::__construct(); // vždy je potřeba volat rodičovský konstruktor

	$this->zarizeni = $Zarizeni;
	$this->faze = $Data_fazeRepository;
	$this->global = $Data_globalRepository;
	$this->template->faze1 = $this->faze->fazeAktualni($this->zarizeni, 1);
    }

    public function render()
    {
	$this->template->setFile(__DIR__ . '/ZarizeniHodnoty.latte');

	$this->template->zarizeni = $this->zarizeni;
	$this->template->faze1 = $this->faze->fazeAktualni($this->zarizeni, 1, $this->id1);
	$this->template->faze2 = $this->faze->fazeAktualni($this->zarizeni, 2, $this->id2);
	$this->template->faze3 = $this->faze->fazeAktualni($this->zarizeni, 3, $this->id3);
	$this->template->global = $this->global->globalAktualni($this->zarizeni);
	$this->template->my_id = $this->id1;
		
	$this->template->render();
    }
    
    public function handlePlus($faze, $id)
    {
	if ($faze == 1) $this->id1 = $id;
	if ($faze == 2) $this->id2 = $id; 
	if ($faze == 3) $this->id3 = $id;
	if (!$this->presenter->isAjax()) {
	    $this->presenter->redirect('this');
	} else {
	    $this->presenter->redirect('this');
	    //$this->invalidateControl();
	}
    }
}
