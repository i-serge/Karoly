<?php
/*
 * Created on Nov 15, 2011
 *
 * @author Sergio Morales López
 */
 
class User extends Doctrine_Record{
	
	public function setTableDefinition() {
        $this->hasColumn('user_id', 'integer', null, array(
            'primary' => true, 'autoincrement' => true));
        $this->hasColumn('name', 'string', 50);
        $this->hasColumn('lastname', 'string', 50);
        $this->hasColumn('slastname', 'string', 50);
        $this->hasColumn('email', 'string', 50, array('unique' => 'true'));
        $this->hasColumn('password', 'string', 25);
        $this->hasColumn('telephone', 'string', 20);
        $this->hasColumn('userType_id', 'integer');
    }

    public function setUp() {
        $this->setTableName('user');
        $this->actAs('Timestampable');
        $this->actAs('SoftDelete');
        $this->hasmutator('password', '__md5');
        
        // This user's userType level
        $this->hasOne('userType', array(
        	'local'		=> 'userType_id',
        	'foreign'	=> 'userType_id'
        ));
        
        // The folders that belong to this user
        $this->hasMany('folder as folders', array(
        	'local'		=> 'user_id',
        	'foreign'	=> 'folder_id',
        	'refClass'	=> 'user_folder'
        ));
    }
    
    protected function __md5($value){
    	$this->_set('password', md5($value));
    }
}