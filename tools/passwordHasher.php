<?php

require __DIR__ . '/../app/bootstrap.php';

$password = Nette\Security\Passwords::hash('xxx');

echo $password;
exit;
