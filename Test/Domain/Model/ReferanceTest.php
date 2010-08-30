<?php
class Test_Domain_Model_ReferanceTest extends Test_Case
{
	public function testCallMaigicMethodsForSingleReferance()
	{
		$arguments = array('Foo', Domain_Model_Criteria::buildEmpty(new Table_Bugs()));
		$referance_map = $this->getMock(
			'Domain_Model_Referance', array('_buildSingleReferance'), $arguments);
		
		$arg1 = 'Account';
		$arg2 = null;
		$referance_map->expects($this->once())
        	->method('_buildSingleReferance')
        	->with($this->equalTo($arg1, $arg2));
		
        $referance_map->getAccountModel();
	}
	
	public function testCallMaigicMethodsForManyToManyReferance()
	{
		$arguments = array('Foo', Domain_Model_Criteria::buildEmpty(new Table_Users()));
		$referance_map = $this->getMock(
			'Domain_Model_Referance', array('_buildManyToManyReferance'), $arguments);
		
		$arg1 = 'Product';
		$arg2 = 'Account';
		$arg3 = null;
		$arg4 = null;
		$referance_map->expects($this->once())
        	->method('_buildManyToManyReferance')
        	->with($this->equalTo($arg1, $arg2, $arg3, $arg4));
		
        $referance_map->getProductModelThroughAccount();
	}
}