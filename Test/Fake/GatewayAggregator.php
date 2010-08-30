<?php
class Test_Fake_GatewayAggregator implements Domain_Gateway_AgregatorInterface
{
	public $options = array();
	
	public $class = null; 
	
	
	public static function getGatewayParameters()
	{
		return array('a_param1', 'a_param2');
	}

	public static function getGatewayClass()
	{
		return 'Test_Fake_NullGateway';
	}
}