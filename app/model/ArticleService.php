<?php

namespace App\Model;

use Nette;


class ArticleService extends Nette\Object
{

	const TABLE = 'articles';

	/** @var Nette\Database\Context */
	private $database;


	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * @return Nette\Database\Table\Selection
	 */
	public function findAll()
	{
		return $this->database->table(self::TABLE);
	}


	/**
	 * @param int $id
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function findById($id)
	{
		return $this->database->table(self::TABLE)->get($id);
	}


	/**
	 * @param array|Nette\Utils\ArrayHash $values
	 * @return Nette\Database\Table\ActiveRow
	 */
	public function insert($values)
	{
		return $this->database->table(self::TABLE)->insert($values);
	}

}
