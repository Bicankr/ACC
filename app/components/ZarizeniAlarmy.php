<?php
namespace Todo;
use Nette;

class ZarizeniAlarmyControl extends Nette\Application\UI\Control
{
    private $alarmy;
    private $id_zarizeni;

    public function __construct($alarmy, $id_zarizeni)
    {
	parent::__construct(); // vždy je potřeba volat rodičovský konstruktor

	$this->alarmy = $alarmy;
	$this->id_zarizeni = $id_zarizeni;
    }

    public function render()
    {
	$this->template->setFile(__DIR__ . '/ZarizeniAlarmy.latte');

	$this->template->alarmy = $this->alarmy->getAlarmy($this->id_zarizeni);
	$this->template->render();
    }
    
}
