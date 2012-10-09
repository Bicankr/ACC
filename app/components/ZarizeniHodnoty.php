<?php
namespace Todo;
use Nette;

class ZarizeniHodnotyControl extends Nette\Application\UI\Control
{
    private $faze;
    private $global;

    public function __construct($Data_fazeRepository, $Data_globalRepository)
    {
	parent::__construct(); // vždy je potřeba volat rodičovský konstruktor

	$this->faze = $Data_fazeRepository;
	$this->global = $Data_globalRepository;
    }

    public function render()
    {
	$this->template->setFile(__DIR__ . '/ZarizeniHodnoty.latte');

	$this->template->faze1 = $this->faze->fazeAktualni(1);
	$this->template->faze2 = $this->faze->fazeAktualni(2);
	$this->template->faze3 = $this->faze->fazeAktualni(3);
	$this->template->global = $this->global->globalAktualni(10);

	$this->template->render();
    }
}
