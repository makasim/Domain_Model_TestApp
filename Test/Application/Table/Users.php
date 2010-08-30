<?php
class Test_Application_Table_Users extends Test_Case
{   
    public function testGetDependentTableDataWithoutCriterias()
    {
    	$users = new Table_Users();
    	$bugs = new Table_Bugs();
    	
    	$select = $users->getSelectToDependent($bugs, 'Developer')
    		->distinct();
    		
    	$this->assertSelectEqualsDataset($select, 'TestGetDependentTableDataWithoutCriterias');
    }
    
    public function testGetDependentTableDataWithDependentCriteria()
    {
    	$users = new Table_Users();
    	$bugs = new Table_Bugs();
    	
    	$bugs_select = $bugs->select()->where('status = ?', 'new');
    	
    	$select = $users->getSelectToDependent($bugs, 'Developer', null, $bugs_select)
    		->distinct();
    		
    	$this->assertSelectEqualsDataset($select, 'TestGetDependentTableDataWithDependentCriteria');
    }
   
    public function testGetParentTableDataWithCriteria()
    {
    	$users = new Table_Users();
    	$bugs = new Table_Bugs();
    
    	$bugs_select = $bugs->select()->where('status = ?', 'assign');
    	
    	$name = $users->quoteColumnAs('name');
    	$users_select = $users->select()->where("$name = ?", 'maksim');
    	
    	$select = $users->getSelectToDependent($bugs, 'Customer', $users_select, $bugs_select)
    		->distinct();
    		
    	$this->assertSelectEqualsDataset($select, 'TestGetParentTableDataWithCriteria');
    }
    
	protected function _getFixtureDir()
    {
    	return FIXTURE_DIR . '/Application/Table/Users';
    }
}