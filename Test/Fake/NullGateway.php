<?php
class Test_Fake_NullGateway extends Domain_Gateway_Null
{
	protected $_options = array();
	
	public function __construct(array $options = array())
	{
		$this->_options = $options;
	}
	
	public function getOptions()
	{
		return $this->_options;
	}
}