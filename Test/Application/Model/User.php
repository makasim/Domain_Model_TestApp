<?php
class Test_Application_Model_User extends Test_Case
{	
	public function testCreateDeveloper()
	{
		$user = Model_User::createDeveloper('new_developer');
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($user), 'TestCreateDeveloper');
	}
	
	public function testGetDevelopers()
	{
		$users = Model_User::getDevelopers();
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($users), 'TestGetDevelopers');
	}

	public function testDeleteDevelopers()
	{
		Model_User::getDevelopers()->delete();
		$users = Model_User::getAll();
	
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($users), 'TestDeleteDevelopers');
	}
	
	public function testChangeRole()
	{
		Model_User::getById(1)->changeRole('customer');
		$users = Model_User::getAll();
		
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($users), 'TestChangeRole');
	}
	
	public function testGetAssignedBugs()
	{
		$bugs = Model_User::getById(1)->getAssignedBugs();
		
		$this->assertType('Model_Bug', $bugs);
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($bugs), 'TestGetAssignedBugs');
	}
	
	public function testGetReportedBugs()
	{		
		$bugs = Model_User::getById(3)->getReportedBugs();
		$this->assertType('Model_Bug', $bugs);
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($bugs), 'TestGetReportedBugs');
	}
	
	public function testCountUsers()
	{
		$this->assertEquals(6, Model_User::getAll()->count());
		$this->assertEquals(1, Model_User::getById(2)->count());
	}
	
	public function testEquals()
	{
	//	$this->assertTrue(Model_User::getAll()->isUsersTheSame(Model_User::getAll()));
	//	$this->assertFalse(Model_User::getAll()->isUsersTheSame(Model_User::getById(1)));
	}
    
	protected function _getFixtureDir()
    {
    	return FIXTURE_DIR . '/Application/Model/User';
    }
}