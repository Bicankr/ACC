<?php
namespace Todo;
use Nette;

class ZarizeniEditaceControl extends Nette\Application\UI\Control
{
    private $id_zarizeni;

    public function __construct($id_zarizeni)
    {
	parent::__construct(); // vždy je potřeba volat rodičovský konstruktor

	$this->id_zarizeni = $id_zarizeni;
    }

    public function render()
    {
	$this->template->setFile(__DIR__ . '/ZarizeniEditace.latte');

	$this->template->render();
    }
    
}
