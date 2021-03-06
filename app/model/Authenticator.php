<?php

namespace App\Model;

use Nette;


/**
 * Users authenticator.
 */
class Authenticator extends Nette\Object implements Nette\Security\IAuthenticator
{

	/** @var Nette\Database\Context */
	private $database;


	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}


	/**
	 * Performs an authentication.
	 * @return Nette\Security\Identity
	 * @throws Nette\Security\AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;
		/** @var Nette\Database\Table\ActiveRow $row */
		$row = $this->database->table('users')->where('username', $username)->fetch();

		if ( ! $row) {
			throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
		} elseif ( ! Nette\Security\Passwords::verify($password, $row->password)) {
			throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
		}

		return new Nette\Security\Identity($row->id, NULL, $row->toArray());
	}

}
