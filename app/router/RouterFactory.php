<?php

namespace App\Router;

use Nette;


class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new Nette\Application\Routers\RouteList();
		$router[] = new Nette\Application\Routers\Route('<presenter>/<action>[/<id>]', [
			'presenter' => 'Article',
			'action' => 'default',
		]);

		return $router;
	}

}

