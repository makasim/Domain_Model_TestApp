<?php
class AllTests
{
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PHPUnit');
        $suite->addTest(Test_Domain_AllTests::suite());
        $suite->addTest(Test_Application_AllTests::suite());
        
        return $suite;
    }
}