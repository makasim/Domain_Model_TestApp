<?php
class Test_Domain_AllTests extends PHPUnit_Framework_TestSuite
{
	public static function suite()
    {
        $suite = new self('Lib');
        $suite->addTestSuite('Test_Domain_Gateway_Builder');
 
        return $suite;
    }
}