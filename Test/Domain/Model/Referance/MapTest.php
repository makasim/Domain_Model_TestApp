<?php
class Test_Domain_Model_Referance_MapTest extends Test_Case
{	
	protected $_testOption = array();
	
	public function setUp()
	{
		$this->_testOption = array(
			'parentModelClass' => 'Foo',
			'dependentModelClass' => 'Bar',
			'tableReferanceRule' => 'Fix');
	}
	
	public function testSetReferances()
	{
		$map = new Domain_Model_Referance_Map();
		
		//invalid referance
		$this->assertEquals(false, $map->getReferance('fake'));
		
		$map->setReferance('account', $this->_testOption);
		$this->assertEquals(
			$this->getReferanceItem('account', $this->_testOption), $map->getReferance('account'));
		$map->setReferance(array('account' => $this->_testOption));
		$this->assertEquals(
			$this->getReferanceItem('account', $this->_testOption), $map->getReferance('account'));
		
		//without table referance
		$options = $this->_testOption;
		$options['tableReferanceRule'] = null;
		$map->setReferance('account', $options);
		$expected_options = $this->_testOption;
		$expected_options['tableReferanceRule'] = 'account';
		$this->assertEquals(
			$this->getReferanceItem('account', $expected_options), $map->getReferance('account'));
	}
	
	public function testAddReferance()
	{
		$map = new Domain_Model_Referance_Map();
		
		$map->addReferance('account', $this->_testOption);
		$this->assertEquals(
			$this->getReferanceItem('account', $this->_testOption), $map->getReferance('account'));
	}
	
	public function testAddReferanceWithReplacingOldOne()
	{
		$map = new Domain_Model_Referance_Map();
		$map->addReferance('account', $this->_testOption);
		
		$options = $this->_testOption;
		$options['parentModelClass'] = 'Bar';
		$map->addReferance('account', $options);
		
		$this->assertEquals(
			$this->getReferanceItem('account', $options), $map->getReferance('account'));
	}
	
	public function testRemoveReferance()
	{
		$map = new Domain_Model_Referance_Map();
		
		$map->addReferance('account', $this->_testOption);
		$this->assertEquals(
			$this->getReferanceItem('account', $this->_testOption), $map->getReferance('account'));
		
		$map->removeReferance('account');
		
		$this->assertEquals(false, $map->getReferance('account'));
	}
	
	public function testRemoveAllReferance()
	{
		$map = new Domain_Model_Referance_Map();
		
		$map->addReferance('account', $this->_testOption);
		$map->addReferance('foo', $this->_testOption);
		$map->addReferance('bar', $this->_testOption);
		
		$this->assertEquals(
			$this->getReferanceItem('account', $this->_testOption), $map->getReferance('account'));
		$this->assertEquals(
			$this->getReferanceItem('foo', $this->_testOption), $map->getReferance('foo'));
		$this->assertEquals(
			$this->getReferanceItem('bar', $this->_testOption), $map->getReferance('bar'));
		
		$map->removeReferance();
		
		$this->assertEquals(false, $map->getReferance('account'));
		$this->assertEquals(false, $map->getReferance('foo'));
		$this->assertEquals(false, $map->getReferance('bar'));
	}
	
	public function testConstructor()
	{
		$map = new Domain_Model_Referance_Map('account', $this->_testOption);
		$this->assertEquals(
			$this->getReferanceItem('account', $this->_testOption), $map->getReferance('account'));
		
		$map = new Domain_Model_Referance_Map(array('account' => $this->_testOption));
		$this->assertEquals(
			$this->getReferanceItem('account', $this->_testOption), $map->getReferance('account'));
	}
	
	public function getReferanceItem($name, $options)
	{
		return new Domain_Model_Referance_Item($name, $options);
	}
}