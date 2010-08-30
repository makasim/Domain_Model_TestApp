<?php
class Test_Application_Model_Bug extends Test_Case
{	
	public function testChangeStatus()
	{
		$bug = Model_Bug::getById(2)->changeStatus(Model_Bug::STATUS_RESOLVED);
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($bug), 'TestChangeStatus');
	}
	
	public function testCreateBug()
	{
		$customer = Model_User::getById(4);
		$developer = Model_User::getById(1);
		$bug = Model_Bug::create('New bug', $customer, $developer);
		
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($bug), 'TestCreateBug');
	}
	
	public function testGetDevelopers()
	{
		$users = Model_Bug::getByStatus(Model_Bug::STATUS_NEW)->getDevelopers();

		$this->assertType('Model_User', $users);
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($users), 'TestGetDevelopers');
	}
	
	public function testBugsChangeStatusForTheUser()
	{
		Model_User::getById(1)->getAssignedBugs()->changeStatus(Model_Bug::STATUS_RESOLVED);
		$bugs = Model_Bug::getByStatus(Model_Bug::STATUS_RESOLVED);
	
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($bugs), 'TestBugsChangeStatusForTheUser');
	}
	
	public function testBugsChangeStatusFromManyRelations()
	{
		Model_Bug::getByStatus(Model_Bug::STATUS_NEW) //instance of Model_Bugs
			->getDevelopers() //instance of Model_User
			->getAssignedBugs() //instance of Model_Bugs
			->changeStatus(Model_Bug::STATUS_RESOLVED);
		$bugs = Model_Bug::getByStatus(Model_Bug::STATUS_RESOLVED);

		$this->assertCriteriaEqualsDataset($this->_getModelGateway($bugs), 'TestBugsChangeStatusFromManyRelations');
	}
	
	public function testDeleteDevelopers()
	{
		Model_Bug::getByStatus(Model_Bug::STATUS_ASSIGNED)->getDevelopers()->delete();
		$users = Model_User::getAll();
		
		$this->assertCriteriaEqualsDataset($this->_getModelGateway($users), 'TestDeleteDevelopers');
	}
	
	public function testChangeDevelopersName()
	{
		$users = Model_Bug::getByStatus(Model_Bug::STATUS_ASSIGNED)->getDevelopers()->changeName('foo');		

		$this->assertCriteriaEqualsDataset($this->_getModelGateway($users), 'TestChangeDevelopersName');
	}
	
	public function testCountUsers()
	{
		$this->assertEquals(2, Model_Bug::getAll()->getDevelopers()->count());
		$this->assertEquals(1, Model_Bug::getById(16)->getDevelopers()->count());
	}
	
	public function testEquals()
	{
	/*	$this->assertTrue(
			Model_Bug::getAll()->getDevelopers()->isUsersTheSame(Model_User::getById(array(1, 2))));
			
		$this->assertTrue(
			Model_Bug::getAll()->getDevelopers()->isUsersTheSame(Model_Bug::getAll()->getDevelopers()));
		
		$this->assertFalse(
			Model_Bug::getAll()->getDevelopers()->isUsersTheSame(Model_User::getAll()));*/
	}
    
    protected function _getFixtureDir()
    {
    	return FIXTURE_DIR . '/Application/Model/Bug';
    }
}