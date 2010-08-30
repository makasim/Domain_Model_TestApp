<?php
class Model_Product extends Domain_Model_Abstract
{
  public function getList($fields = null)
  {
    return $this->_getGateway()->get($fields);
  }
	
	/**
	 * 
	 * @return Model_User
	 */
	public function getDevelopers()
	{
		return $this->_createManyToManyModel(
			Model_User::getAll(), Model_Bug::getAll(), 'Product', 'Developer');	
	}
	
	public static function getGatewayParameters()
	{
		return array(
			'tableClass' => 'Table_Products');		
	}
}