<?php

namespace App\Presenters;

use Nette;


class UserPresenter extends Nette\Application\UI\Presenter
{

	/** @var string $backlink @persistent */
	public $backlink = '';


	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentLoginForm()
	{
		$form = new Nette\Application\UI\Form();
		$form->addText('username', 'Username:')
			->setRequired('Please enter your username.');
		$form->addPassword('password', 'Password:')
			->setRequired('Please enter your password.');
		$form->addSubmit('send', 'Log in');

		$form->addProtection();
		$form->onSuccess[] = $this->signInFormSucceeded;

		return $form;
	}


	/**
	 * @param Nette\Forms\Form $form
	 * @param array|Nette\Utils\ArrayHash $values
	 */
	public function signInFormSucceeded(Nette\Forms\Form $form, $values)
	{
		try {
			$this->getUser()->login($values->username, $values->password);
		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
			return;
		}

		$this->restoreRequest($this->backlink);
		$this->redirect('Article:default');
	}


	public function actionLogout()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been logged out.');
		$this->redirect('login');
	}

}
