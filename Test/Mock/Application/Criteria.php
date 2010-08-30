<?php
class Test_Mock_Application_Criteria extends Domain_Model_Criteria 
{
	protected static $_last_instance = null;
	
	public function __construct(Zend_Db_Table_Select $select, $simple = true)
	{
		parent::__construct($select, $simple);
		self::$_last_instance = $this;
	}
	
	public static function getLastInstance()
	{
		return self::$_last_instance;
	}
}