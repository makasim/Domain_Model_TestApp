<?php
class Test_Domain_Gateway_Builder extends PHPUnit_Framework_TestCase
{
	public function testBuildingGatewayWithoutParameters()
	{
		$this->assertType('Domain_Gateway_Null', Domain_Gateway_Builder::factory());
	}
	
	public function testBuildingGatewayWithTwoParameters()
	{
		$gatewayClass = 'Test_Fake_NullGateway';
		$options = array('someparam');
		$gateway = Domain_Gateway_Builder::factory($gatewayClass, $options);
		
		$this->assertType($gatewayClass, $gateway);
		$this->assertEquals($options, $gateway->getOptions());
	}
	
	public function testBuildingGatewayWithTwoParametersAndInvalidGatewayClassName()
	{
		$invalidGatewayClass = 'stdClass';
		try {
			Domain_Gateway_Builder::factory($invalidGatewayClass, $options = array());
		} catch (Domain_Gateway_Exception $e) {
			return;
		}
		
		$this->fail('Must be thrown the exception becouse given gateway class name is not correct');
	}
	
	public function testBuildingGatewayWithClassNotImplementedAgregatorInterface()
	{
		$invalidAgregatorClass = 'stdClass';
		try {
			Domain_Gateway_Builder::factory($invalidAgregatorClass);
		} catch (Domain_Gateway_Exception $e) {
			return;
		}
		
		$this->fail('Must be thrown the exception becouse given Wrong agregator class name');
	}

	public function testBuildingGatewayWithClassImplementedAgregatorInterface()
	{
		$agregatorClass = 'Test_Fake_GatewayAggregator';
		$gateway = Domain_Gateway_Builder::factory($agregatorClass);
		
		$this->assertType(Test_Fake_GatewayAggregator::getGatewayClass(), $gateway);
		$this->assertEquals(Test_Fake_GatewayAggregator::getGatewayParameters(), $gateway->getOptions());
	}
}