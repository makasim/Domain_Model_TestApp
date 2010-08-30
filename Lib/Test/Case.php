<?php
abstract class Test_Case extends PHPUnit_Extensions_Database_TestCase 
{
	public function assertCriteriaEqualsDataset(Domain_Gateway_Select $gateway, $path_to_expected_dataset)
	{
		$this->assertSelectEqualsDataset($gateway->select(), $path_to_expected_dataset);
	}
	
	public function assertSelectEqualsDataset(Zend_Db_Table_Select $select, $path_to_expected_dataset)
	{
		$expected_dataset = $this->_loadExpectedDataset($path_to_expected_dataset);
		$expected_dataset->assertEquals($this->_createRealDataset($select));
	}
	
	protected function _loadExpectedDataset($path)
    {
    	return new PHPUnit_Extensions_Database_DataSet_FlatXmlDataSet(
    		$this->_getFixtureDir() . '/' . $path . '.xml');
    }
    
 	protected function _createRealDataset(Zend_Db_Table_Select $select)
    {
    	$dataset = new PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
   		$dataset->addTable($select->getTable()->getName(), (string) $select);

   		return $dataset;
    }
    
	  protected function getConnection()
    {
    	 $pdo = new PDO(
			'mysql:host=127.0.0.1;dbname=domain-model;unix_socket=/var/run/mysqld/mysqld.sock',
			'root',
			'',
			array());
    	
        return $this->createDefaultDBConnection($pdo, 'domain-model');
    }
 
    protected function getDataSet()
    {
        return $this->createFlatXMLDataSet(FIXTURE_DIR . '/Application/Common/dataset.xml');
    }
    
    protected function _getFixtureDir()
    {
    	return FIXTURE_DIR;
    }
    
    protected function _getModelGateway(Domain_Model_Abstract $model)
    {
    	$modelReflector = new ReflectionObject($model);
    	$propertyReflector = $modelReflector->getProperty('_gateway');
    	$propertyReflector->setAccessible(true);
  
    	return $propertyReflector->getValue($model);
    }
}