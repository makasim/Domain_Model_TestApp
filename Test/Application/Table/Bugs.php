<?php
class Test_Application_Table_Bugs extends Test_Case
{    
    public function testGetParentTableDataWithoutCriterias()
    {   		
   		$bugs = new Table_Bugs();
   		$users = new Table_Users();
   		
    	$select = $bugs->getSelectToParent($users, 'Developer')
    		->distinct();
    	
    	$this->assertSelectEqualsDataset($select, 'TestGetParentTableDataWithoutCriterias');
    }
    
	public function testGetParentTableDataWithParentCriteria()
    {
   		$bugs = new Table_Bugs();
   		$users = new Table_Users();
    	
    	$name =  $users->quoteColumnAs('name');
    	$users_select = $users->select()->where("$name = ?", 'maksim');
   		
    	$select = $bugs->getSelectToParent($users, 'Developer', null, $users_select)
			->distinct();   			

		$this->assertSelectEqualsDataset($select, 'TestGetParentTableDataWithParentCriteria');
    }
    
	public function testGetParentTableDataWithCriteria()
    {
   		$bugs = new Table_Bugs();
   		$users = new Table_Users();
    	
    	$name =  $users->quoteColumnAs('name');
    	$users_select = $users->select()->where("$name = ?", 'maksim');
   		
    	$status =  $bugs->quoteColumnAs('status');
    	$bugs_select = $bugs->select()
    		->where("$status = ?", 'new')
   			->orWhere("$status = ?", 'closed');
   			
   		$select = $bugs->getSelectToParent($users, 'Customer', $bugs_select, $users_select)
   			->distinct();
   			
    	$this->assertSelectEqualsDataset($select, 'TestGetParentTableDataWithCriteria');
    }
    
	protected function _getFixtureDir()
    {
    	return FIXTURE_DIR . '/Application/Table/Bugs';
    }
}