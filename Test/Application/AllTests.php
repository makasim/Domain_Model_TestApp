<?php
class Test_Application_AllTests extends PHPUnit_Framework_TestSuite
{	
	public static function suite()
    {
        $suite = new self('App');
        
        $suite->addTestSuite('Test_Application_Table_Users');
        $suite->addTestSuite('Test_Application_Table_Bugs');
        $suite->addTestSuite('Test_Application_Table_Products');
        
        
     	$suite->addTestSuite('Test_Application_Model_User');
		$suite->addTestSuite('Test_Application_Model_Bug');
        $suite->addTestSuite('Test_Application_Model_Product');
 
        return $suite;
    }
}