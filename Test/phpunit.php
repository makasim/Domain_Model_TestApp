<?php
define('ROOT_DIR', realpath(__DIR__ . '/..'));
define('FIXTURE_DIR', ROOT_DIR . '/Test/Fixture');

$includePaths = array(ROOT_DIR, ROOT_DIR . '/Lib', ROOT_DIR . '/Application');
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $includePaths));

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()
	->registerNamespace('Domain')
	->registerNamespace('Test')
	->registerNamespace('PHPUnit')
	->registerNamespace('Table')
	->registerNamespace('Model');
	
Domain_Autoloader::getInstance()->regestry();

//initDb
$db = Zend_Db::factory('Pdo_Mysql', array(
	'host' => '127.0.0.1',
	'username' => 'root',
	'password' => '',
	'dbname' => 'domain-model',
	'unix_socket' => `mysql_config --socket`));

$db->setFetchMode(Zend_Db::FETCH_OBJ);
Zend_Db_Table_Abstract::setDefaultAdapter($db);

unset($includePaths, $resAutoloader, $autoloader, $db);

require ROOT_DIR . '/Lib/phpunit/phpunit.php';