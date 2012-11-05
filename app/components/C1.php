<?php 
namespace Todo;
use Nette;

class C1Control extends Nette\Application\UI\Control
{
    /** @persistent */
    public $foo;
    private $zarizeni;

    public function __construct($par)
    {
        parent::__construct(); // vždy je potřeba volat rodičovský konstruktor
	$this->zarizeni = $par;
    }
    public function render()
    {
        $this->template->setFile(__DIR__ . '/C1.latte');
        $this->template->foo = $this->zarizeni;
        $this->template->render();
    }
    public function handleFooMinus(){
	//$this->foo -= 1;
	if (!$this->presenter->isAjax()) {
	    $this->presenter->redirect('this');
	} else {
	    $this->invalidateControl();
	}
    }
    public function handleFooPlus(){
	//$this->foo += 1;
	if (!$this->presenter->isAjax()) {
    	    $this->presenter->redirect('this');
	} else {
	    $this->invalidateControl();
	}
    }
}