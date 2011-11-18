<?php
/*
 * Created on Nov 15, 2011
 *
 * @author Sergio Morales López
 */
 
class Archivo extends Doctrine_Record{
	
	public function setTableDefinition() {
        $this->hasColumn('archivo_id', 'integer', null, array(
            'primary' => true, 'autoincrement' => true));
        $this->hasColumn('description', 'string', 50);
        $this->hasColumn('route', 'string', 255);
        $this->hasColumn('folder_id', 'integer');
    }

    public function setUp() {
        $this->setTableName('archivo');
        $this->actAs('Timestampable');
        $this->actAs('SoftDelete');
        
        // Users that own this folder
        $this->hasOne('folder', array(
        	'local'		=> 'folder_id',
        	'foreign'	=> 'folder_id'
        ));
    }
}