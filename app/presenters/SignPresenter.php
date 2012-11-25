<?php
use Nette\Application\UI;
/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{
	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
    	private $user_logRepository;

	protected function createComponentSignInForm()
	{
	    	$this->user_logRepository = $this->context->user_logRepository;

		$form = new UI\Form;
		$form->addText('username', 'Jméno:')
			->setRequired('Please enter your username.');

		$form->addPassword('password', 'Heslo:')
			->setRequired('Please enter your password.');

		$form->addCheckbox('remember', 'Zapamatovat si');

		$form->addSubmit('send', 'Sign in');

		// call method signInFormSubmitted() on success
		$form->onSuccess[] = $this->signInFormSubmitted;
		return $form;
	}

	public function signInFormSubmitted($form)
	{
		$values = $form->getValues();

		if ($values->remember) {
		    $this->getUser()->setExpiration('+ 14 days', FALSE);
		} else {
		    $this->getUser()->setExpiration('+ 20 minutes', TRUE);
		}

		try {
		    $this->getUser()->login($values->username, $values->password);
		    $this->flashMessage($this->getUser()->id);
		    $this->user_logRepository->log_user_login($this->getUser()->id);
		} catch (Nette\Security\AuthenticationException $e) {
		    $form->addError($e->getMessage());
		    return;
		}

		$this->redirect('Homepage:');
    
	}

	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('Odhlášený uživatel.');
		$this->redirect('in');
	}

}
