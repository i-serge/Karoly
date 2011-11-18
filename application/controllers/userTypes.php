<?php
/*
 * Created on Nov 17, 2011
 *
 * @author Sergio Morales López
 */
 
class userTypes extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index() {
        redirect('/userTypes/listing/');
    }
	
	public function listing($userType_id = FALSE){
		$this->data['userTypes'] = Doctrine_Query::create()->select('u.*')->from('userType u')->execute();
		$this->load->view('/userTypes/list', $this->data);
	}
	
	public function insert($userType_id = FALSE){
		$this->data['userType'] = ($userType_id) ? Doctrine::getTable('userType')->findOneBy('userType_id', $userType_id) : new userType();
        if (!is_object($this->data['userType']))
            $this->data['userType'] = new userType();

        $this->__set_form_validation_rules($userType_id);

        if ($this->form_validation->run() == FALSE) {
            $this->data['form_errors'] = validation_errors();
            $this->load->view('/userTypes/add_form', $this->data);
        } else {
            $this->data['userType']->description	= $this->input->post('description', true);
            $this->data['userType']->save();
            redirect('userTypes');
        }
	}
	
	public function delete($userType_id){
		$userType = new userType();
        $userType = $userType->getTable()->findOneBy('userType_id', $userType_id);
        
        if (is_object($userType)) {
            $userType->delete();
        }
        redirect('userTypes');
	}
	
	private function __set_form_validation_rules($userType_id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', 'Descripcion', 'required|min_length[3]');
    }
}