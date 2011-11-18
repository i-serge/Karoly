<?php
/*
 * Created on Nov 16, 2011
 *
 * @author Sergio Morales López
 */
 
class Operation extends Doctrine_Record{
	
	public function setTableDefinition() {
        $this->hasColumn('operation_id', 'integer', null, array(
            'primary' => true, 'autoincrement' => true));
        $this->hasColumn('description', 'string', 50, array(
        	'notnull'	=> 'true'
        ));
        $this->hasColumn('controller', 'string', 255, array(
        	'notnull'	=> 'true'
        ));
        $this->hasColumn('parent_operation_id', 'integer', null, array(
        	'notnull'	=> 'true'
        ));
    }

    public function setUp() {
        $this->setTableName('operation');
        $this->actAs('Timestampable');
        $this->actAs('SoftDelete');
        
        // The userTypes that can execute this operation
        $this->hasMany('userType as userTypes', array(
        	'local'		=> 'operation_id',
        	'foreign'	=> 'userType_id',
        	'refClass'	=> 'userType_operation'
        ));
        
        // The parent controller (if any) of this controller
        $this->hasOne('operation as parent_operation', array(
        	'local'		=> 'parent_operation_id',
        	'foreign'	=> 'operation_id'
        ));
        
        // The child operations (if any) of this operation
        $this->hasMany('operation as child_operations', array(
        	'local'		=> 'operation_id',
        	'foreign'	=> 'parent_operation_id'
        ));
    }
}