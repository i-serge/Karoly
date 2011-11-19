<?php
/*
 * Created on Nov 15, 2011
 *
 * @author Sergio Morales López
 */
 
class Folder extends Doctrine_Record{
	
	public function setTableDefinition() {
        $this->hasColumn('folder_id', 'integer', null, array(
            'primary' => true, 'autoincrement' => true));
        $this->hasColumn('description', 'string', 50);
        $this->hasColumn('folder_padre_id', 'integer', null);
    }

    public function setUp() {
        $this->setTableName('folder');
        $this->actAs('Timestampable');
        $this->actAs('SoftDelete');
        
        // Users that own this folder
        $this->hasMany('user as users', array(
        	'local'		=> 'folder_id',
        	'foreign'	=> 'user_id',
        	'refClass'	=> 'user_folder'
        ));
        
        // The folder containing this folder (if any)
        $this->hasOne('folder as folder_padre', array(
        	'local'		=> 'folder_padre_id',
        	'foreign'	=> 'folder_id'
        ));
        
        // Folders that belong to this folder
        $this->hasMany('folder as child_folders', array(
        	'local'		=> 'folder_id',
        	'foreign'	=> 'folder_padre_id'
        ));
        
        // Images that belong to this folder
        $this->hasMany('archivo as archivos', array(
        	'local'		=> 'folder_id',
        	'foreign'	=> 'folder_id'
        ));
        
        // The permission levels this folder has for each user type
        $this->hasMany('usertype as usertypes', array(
        	'local'		=> 'folder_id',
        	'foreign'	=> 'userType_id',
        	'refClass'	=> 'folder_usertype'
        ));
    }
}