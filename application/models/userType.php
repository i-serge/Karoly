<?php
/*
 * Created on Nov 15, 2011
 *
 * @author Sergio Morales López
 */
 
class UserType extends Doctrine_Record{
	
	public function setTableDefinition() {
        $this->hasColumn('userType_id', 'integer', null, array(
            'primary' => true, 'autoincrement' => true));
        $this->hasColumn('description', 'string', 50, array(
        	'unique'	=> 'true',
        	'notnull'	=> 'true'
        ));
    }

    public function setUp() {
        $this->setTableName('userType');
        $this->actAs('Timestampable');
        $this->actAs('SoftDelete');
        
        // The users that are grouped in this user_type level
        $this->hasMany('user as users', array(
        	'local'		=> 'userType_id',
        	'foreign'	=> 'userType_id'
        ));
        
        // The operations this user_type is allowed to perform
        $this->hasMany('operation as operations', array(
        	'local'		=> 'userType_id',
        	'foreign'	=> 'operation_id',
        	'refClass'	=> 'userType_operation'
        ));
        
        // The permission levels this userType has on each folder
        $this->hasMany('folder as folders', array(
        	'local'		=> 'userType_id',
        	'foreign'	=> 'folder_id',
        	'refClass'	=> 'folder_usertype'
        ));
        
    }
}