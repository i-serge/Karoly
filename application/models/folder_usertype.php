<?php
/*
 * Created on Nov 16, 2011
 *
 * @author Sergio Morales López
 */
 
class Folder_userType extends Doctrine_Record{
	
	public function setTableDefinition() {
        $this->hasColumn('folder_id', 'integer', null, array(
			'primary' => true
        ));
		$this->hasColumn('userType_id', 'integer', null, array(
			'primary' => true
        ));
		$this->hasColumn('reading', 'boolean');
		$this->hasColumn('writing', 'boolean');
		$this->hasColumn('erasing', 'boolean');
    }
}