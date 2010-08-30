<?php
class Test_Application_Table_Products extends Test_Case
{
    public function testGetUsersDataWithoutCriterias()
    {
    	$products = new Table_Products();
    	$users = new Table_Users();
    	$bugs = new Table_Bugs();
    	
    	$select = $products->getSelectManyToMany($users, $bugs, 'Product', 'Developer')
    		->distinct();
    		
    	$this->assertSelectEqualsDataset($select, 'TestGetUsersDataWithoutCriterias');
    }
    
    public function testGetUsersTableDataWithUserCriteria()
    {
    	$products = new Table_Products();
    	$users = new Table_Users();
    	$bugs = new Table_Bugs();
    	
    	$name = $users->quoteColumnAs('name');
    	$users_select = $users->select()->where("$name = ?", 'maksim');
    	
    	$select = $products->getSelectManyToMany($users, $bugs, 'Product', 'Developer', null, $users_select)
    		->distinct();
    		
    	$this->assertSelectEqualsDataset($select, 'TestGetUsersTableDataWithUserCriteria');
    }
    
    public function testGetParentTableDataWithCriteria()
    {	
    	$products = new Table_Products();
    	$users = new Table_Users();
    	$bugs = new Table_Bugs();
    	
    	$name = $products->quoteColumnAs('name');
    	$products_select = $products->select()->where("$name = ?", 'unister');
    	
    	$name = $users->quoteColumnAs('name');
    	$users_select = $users->select()->where("$name = ?", 'maksim');
    	
    	$select = $products->getSelectManyToMany($users, $bugs, 'Product',
    		'Developer', $products_select, $users_select);
    	$select->distinct();
    	
    	$this->assertSelectEqualsDataset($select, 'TestGetUsersTableDataWithUserCriteria');
    }
    
	protected function _getFixtureDir()
    {
    	return FIXTURE_DIR . '/Application/Table/Products';
    }
}