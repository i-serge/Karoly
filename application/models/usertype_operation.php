<?php
/*
 * Created on Nov 16, 2011
 *
 * @author Sergio Morales López
 */
 
class UserType_operation extends Doctrine_Record{
	
	public function setTableDefinition() {
        $this->hasColumn('usertype_id', 'integer', null, array(
            'primary' => true)
		);
		$this->hasColumn('operation_id', 'integer', null, array(
            'primary' => true)
		);
    }
}