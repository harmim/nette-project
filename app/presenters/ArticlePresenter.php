<?php

namespace App\Presenters;

use App;
use Nette;


class ArticlePresenter extends Nette\Application\UI\Presenter
{

	/** @var App\Model\ArticleService */
	private $articleService;


	public function __construct(App\Model\ArticleService $articleService)
	{
		parent::__construct();
		$this->articleService = $articleService;
	}


	protected function startup()
	{
		parent::startup();

		if ( ! $this->getUser()->isLoggedIn()) {
			if ($this->getUser()->getLogoutReason() === Nette\Security\IUserStorage::INACTIVITY) {
				$this->flashMessage('You have been signed out due to inactivity. Please sign in again.');
			}
			$this->redirect('User:login', ['backlink' => $this->storeRequest()]);
		}
	}


	public function renderDefault()
	{
		$this->template->articles = $this->articleService->findAll()->order('title')->order('author');
	}


	public function renderEdit($id)
	{
		$this->template->article = $article = $this->articleService->findById($id);
		if ($article) {
			$this->getComponent('editForm')->setDefaults($article);
		}
	}


	public function renderDelete($id)
	{
		$this->template->article = $this->articleService->findById($id);
	}


	/**
	 * Add form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentAddForm()
	{
		$form = new Nette\Application\UI\Form();
		$form->addText('title', 'Title:')
			->setRequired('Please enter an title.');

		$form->addText('author', 'Author:');

		$form->addText('link', 'Link:')
			->setRequired('Please enter a link.')
			->addRule(Nette\Forms\Form::URL);

		$form->addSubmit('add', 'Add')
			->setAttribute('class', 'default');

		$form->addSubmit('cancel', 'Cancel')
			->setValidationScope(FALSE)
			->onClick[] = $this->formCancelled;

		$form->addProtection();
		$form->onSuccess[] = $this->onAddFormSuccessd;

		return $form;
	}


	/**
	 * @param Nette\Forms\Form $form
	 * @param array|Nette\Utils\ArrayHash $values
	 */
	public function onAddFormSuccessd(Nette\Forms\Form $form, $values)
	{
		$this->articleService->insert($values);
		$this->flashMessage('The article has been added.');
		$this->redirect('default');
	}


	/**
	 * Add form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentEditForm()
	{
		$form = new Nette\Application\UI\Form();
		$form->addText('title', 'Title:')
			->setRequired('Please enter an title.');

		$form->addText('author', 'Author:');

		$form->addText('link', 'Link:')
			->setRequired('Please enter a link.')
			->addRule(Nette\Forms\Form::URL);

		$form->addSubmit('edit', 'Edit')
			->setAttribute('class', 'default');

		$form->addSubmit('cancel', 'Cancel')
			->setValidationScope(FALSE)
			->onClick[] = $this->formCancelled;

		$form->addProtection();
		$form->onSuccess[] = $this->onEditFormSuccessd;

		return $form;
	}


	/**
	 * @param Nette\Forms\Form $form
	 * @param array|Nette\Utils\ArrayHash $values
	 */
	public function onEditFormSuccessd(Nette\Forms\Form $form, $values)
	{
		$this->articleService->findById((int) $this->getParameter('id'))->update($values);
		$this->flashMessage('The article has been added.');
		$this->redirect('default');
	}


	/**
	 * Delete form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentDeleteForm()
	{
		$form = new Nette\Application\UI\Form();
		$form->addSubmit('cancel', 'Cancel')
			->onClick[] = $this->formCancelled;

		$form->addSubmit('delete', 'Delete')
			->setAttribute('class', 'default');

		$form->addProtection();
		$form->onSuccess[] = $this->onDeleteFormSucceeded;
		return $form;
	}


	public function onDeleteFormSucceeded()
	{
		$this->articleService->findById($this->getParameter('id'))->delete();
		$this->flashMessage('Article has been deleted.');
		$this->redirect('default');
	}


	public function formCancelled()
	{
		$this->redirect('default');
	}

}
