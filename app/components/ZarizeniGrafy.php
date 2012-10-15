<?php
namespace Todo;
use Nette;

class ZarizeniGrafyControl extends Nette\Application\UI\Control
{
    private $zarizeni; 
    private $faze;
    private $global;

    public function __construct($Zarizeni, $Data_fazeRepository, $Data_globalRepository)
    {
	parent::__construct(); // vždy je potřeba volat rodičovský konstruktor

	$this->zarizeni = $Zarizeni;
	$this->faze = $Data_fazeRepository;
	$this->global = $Data_globalRepository;
    }

    public function render()
    {
	$this->template->setFile(__DIR__ . '/ZarizeniGrafy.latte');

	$this->template->zarizeni = $this->zarizeni;
	$this->template->val1 = $this->faze->fazeHodina($this->zarizeni, 1);
	$this->template->val2 = $this->faze->fazeHodina($this->zarizeni, 2);
	$this->template->val3 = $this->faze->fazeHodina($this->zarizeni, 3);
//	$this->template->faze1 = $this->faze->fazeHodina($this->zarizeni, 1);

	$this->template->render();
    }
}
