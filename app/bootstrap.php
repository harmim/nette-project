<?php

// Define constants
define('ROOT_DIR', realpath(__DIR__ . '/..'));
define('WWW_DIR', ROOT_DIR . '/www');
define('APP_DIR', realpath(__DIR__));
define('VENDOR_DIR', ROOT_DIR . '/vendor');
define('LOG_DIR', ROOT_DIR . '/log');
define('TEMP_DIR', ROOT_DIR . '/temp');

// Load Framework
require VENDOR_DIR . '/autoload.php';

// Configure application
$configurator = new Nette\Configurator();

// Enable Nette Debugger for error visualisation & logging
$configurator->enableDebugger(LOG_DIR);

// Set directory for temp files
$configurator->setTempDirectory(TEMP_DIR);

// Enable RobotLoader - this will load all app classes automatically
$configurator->createRobotLoader()
	->addDirectory(APP_DIR)
	->register();

// Create Dependency Injection container from config.neon file
$configurator->addConfig(APP_DIR . '/config/config.neon');

// Create container from configurator
$container = $configurator->createContainer();
