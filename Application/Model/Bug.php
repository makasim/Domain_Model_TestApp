<?php
class Model_Bug extends Domain_Model_Abstract
{
	const STATUS_NEW = 'new';
	const STATUS_ASSIGNED = 'assign';
	const STATUS_RESOLVED = 'resolved';
	
	protected static $_table_class = 'Table_Bugs';

  public function getList($fields = null)
  {
    return $this->_getGateway()->get($fields);
  }
	
	public function changeStatus($status)
	{
		$this->_update(array('status' => $status));
		return $this;
	}
	
	public function assignTo(Model_User $user)
	{
		$user->_getGateway()->throwIfNotSingle();
		
		$this->_update(array(
			'status' => self::STATUS_ASSIGNED, 
			'assign_to' => $user->_getGateway()->getPrimaryId()));
		
		return $this;
	}
	
	public function getDevelopers()
	{
		return $this->_createParentModel(Model_User::getAll(), 'Developer');
	}
	
	public static function getByStatus($status = self::STATUS_NEW)
	{
		$gateway = static::_getNewGateway();
		$status_col = $gateway->table()->quoteColumnAs('status');
		$gateway->setCriteria($gateway->table()->select()->where("$status_col = ?", $status));
		
		return new self($gateway);
	}
	
	public static function create($name, Model_User $reporter, Model_User $developer = null)
	{
		$reporter->_getGateway()->throwIfNotSingle();
		$reporter_id = $reporter->_getGateway()->getPrimaryId();

		$developer_id = null;
 		if (!is_null($developer)) {
			$developer->_getGateway()->throwIfNotSingle();
 			$developer_id = $developer->_getGateway()->getPrimaryId();	
		}

		return static::_create(array(
			'status' => $developer_id ? self::STATUS_ASSIGNED : self::STATUS_NEW,
			'name' => $name,
			'reported_by' => $reporter_id,
			'assigned_to' => $developer_id));
	}
	
	public static function getGatewayParameters()
	{
		return array(
			'tableClass' => 'Table_Bugs');		
	}
}