<?php
class Model_User extends Domain_Model_Abstract 
{
	const ROLE_CUSTOMER = 'customer';
	const ROLE_DEVELOPER = 'developer';
	
	public function getList($fields = null)
	{
		return $this->_getGateway()->get($fields);
	}
	
	public function changeRole($role) 
	{
		$this->_getGateway()->update(array('role' => $role));
		return $this;
	}
	
	/**
		TODO: need to be covered by test.
	*/
	public function changeName($name) 
	{
		$this->_getGateway()->update(array('name' => $name));
		return $this;
	}
	
	/**
	 * 
	 * @return Model_Bug
	 */
	public function getAssignedBugs()
	{	
		$bugs = Model_Bug::getByStatus(Model_Bug::STATUS_ASSIGNED);
		return $this->_createDependentModel($bugs, 'Developer');		
	}
	
	/**
	 * 
	 * @return Model_Bug
	 */
	public function getReportedBugs()
	{
		$bugs = Model_Bug::getAll();
		return $this->_createDependentModel($bugs, 'Customer');
	}
	
	public function isUsersTheSame(Model_User $user)
	{
		return $this->_getGateway()->equal($user->_getGateway());
	}
	
	public static function createDeveloper($name)
	{		
		return static::_create(array('name' => $name, 'role' => 'developer'));
	}
	
	public static function getDevelopers()
	{
		$gateway = static::_getNewGateway();
		$gateway->setCriteria($gateway->table()->select()->where('role = ?', self::ROLE_DEVELOPER));
		
		return new self($gateway);
	}
	
	public static function getCustomers()
	{
		$gateway = static::_getNewGateway();
		$gateway->setCriteria($gateway->table()->select()->where('role = ?', self::ROLE_CUSTOMER));
		
		return new self($gateway);
	}
	
	public static function getGatewayParameters()
	{
		return array(
			'tableClass' => 'Table_Users');		
	}
}