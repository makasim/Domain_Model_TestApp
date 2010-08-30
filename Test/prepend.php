<?php
define('ROOT_DIR', realpath(__DIR__ . '/..'));
define('FIXTURE_DIR', ROOT_DIR . '/Test/Fixture');

$includePaths = array(ROOT_DIR, ROOT_DIR . '/Lib', ROOT_DIR . '/Application');
set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $includePaths));

require_once 'Zend/Loader/Autoloader.php';
$autoload = Zend_Loader_Autoloader::getInstance();
$autoload->registerNamespace('Domain');
$autoload->registerNamespace('Test');
$autoload->registerNamespace('PHPUnit');
$autoload->registerNamespace('Table');
$autoload->registerNamespace('Model');

$domainLibAutoloader = new Domain_Autoloader();

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