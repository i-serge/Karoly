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
        	'unique'	=> 'true',
        	'notnull'	=> 'true'
        ));
        $this->hasColumn('controller', 'string', 255, array(
        	'unique'	=> 'true',
        	'notnull'	=> 'true'
        ));
        $this->hasColumn('operation_padre_id', 'integer', null, array(
        	'notnull'	=> 'true'
        ));
    }

    public function setUp() {
        $this->setTableName('operation');
        $this->actAs('Timestampable');
        $this->actAs('SoftDelete');
        
        // The userTypes that let this operation to be performed
        $this->hasMany('userType as userTypes', array(
        	'local'		=> 'operation_id',
        	'foreign'	=> 'userType_id',
        	'refClass'	=> 'userType_operation'
        ));
    }
}