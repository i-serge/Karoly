<?php
/*
 * Created on Nov 15, 2011
 *
 * @author Sergio Morales López
 */
 
class User_folder extends Doctrine_Record{
	
	public function setTableDefinition() {
        $this->hasColumn('user_id', 'integer', null, array(
            'primary' => true)
		);
		$this->hasColumn('folder_id', 'integer', null, array(
            'primary' => true)
		);
    }
}