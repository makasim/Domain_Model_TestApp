<?php
class Table_Bugs extends Domain_Table_Abstract 
{
	protected $_name = 'bugs';
	protected $_primary = 'id';
	
	protected $_referenceMap    = array(
        'Customer' => array(
            'columns'           => 'reported_by',
            'refTableClass'     => 'Table_Users',
            'refColumns'        => 'id'
        ),
        'Developer' => array(
            'columns'           => 'assigned_to',
            'refTableClass'     => 'Table_Users',
            'refColumns'        => 'id'
        ),
        'Product' => array(
            'columns'           => 'product_id',
            'refTableClass'     => 'Table_Products',
            'refColumns'        => 'id'
        ),
    );
}