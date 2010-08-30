<?php
class Test_Application_Model_Product extends Test_Case
{
	public function testGetDevelopers()
	{
		$users = Model_Product::getById(1)->getDevelopers();

		$this->assertType('Model_User', $users);
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($users), 'TestGetDevelopers');
	}
	
	public function testDeleteDevelopers()
	{
		Model_Product::getById(2)->getDevelopers()->delete();		
		$users = Model_User::getAll();
		
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($users), 'TestDeleteDevelopers');
	}
	
	public function testChangeDevelopersName()
	{
		$users = Model_Product::getById(2)->getDevelopers()->changeName('foo');		
		
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($users), 'TestChangeDevelopersName');
	}
	
	public function testCountUsers()
	{
		$this->assertEquals(2, Model_Product::getAll()->getDevelopers()->count());
		$this->assertEquals(1, Model_Bug::getById(2)->getDevelopers()->count());
	}
	
	/*public function testEquals()
	{
		$this->assertTrue(
			Model_Product::getAll()->getDevelopers()->isUsersTheSame(Model_User::getById(array(1, 2))));
			
		$this->assertTrue(
			Model_Product::getAll()->getDevelopers()->isUsersTheSame(Model_Product::getAll()->getDevelopers()));
		
		$this->assertFalse(
			Model_Product::getAll()->getDevelopers()->isUsersTheSame(Model_User::getAll()));
	}*/
	
	protected function _getFixtureDir()
    {
    	return FIXTURE_DIR . '/Application/Model/Product';
    }
}