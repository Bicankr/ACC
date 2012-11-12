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
	protected function createComponentSignInForm()
	{
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
