<?php
/*
 * Created on Nov 18, 2011
 *
 * @author Sergio Morales López
 */
 
class operations extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index() {
        redirect('/operations/listing/');
    }
	
	public function listing($operation_id = FALSE){
		$this->data['operations'] = Doctrine_Query::create()->select('o.*')->from('operation o')->execute();
		$this->load->view('/operations/list', $this->data);
	}
	
	public function insert($operation_id = FALSE){
		$this->data['operation'] = ($operation_id) ? Doctrine::getTable('operation')->findOneBy('operation_id', $operation_id) : new operation();
        if (!is_object($this->data['operation']))
            $this->data['operation'] = new operation();

        $this->__set_form_validation_rules($operation_id);

        if ($this->form_validation->run() == FALSE) {
            $this->data['form_errors'] = validation_errors();
            
            $options = array();
            $operations = Doctrine_Query::create()->select('o.*')->from('operation as o')->execute();
            foreach ($operations as $operation)
            	$options[$operation->operation_id] = $operation->description;
            $this->data['options'] = $options;
            
            $this->load->view('/operations/add_form', $this->data);
        } else {
            $this->data['operation']->description			= $this->input->post('description', true);
            $this->data['operation']->controller			= $this->input->post('controller', true);
            $this->data['operation']->parent_operation_id	= $this->input->post('parent_operation_id', true);
            $this->data['operation']->save();
            redirect('operations');
        }
	}
	
	public function delete($operation_id){
		$operation = new operation();
        $operation = $operation->getTable()->findOneBy('operation_id', $operation_id);
        
        if (is_object($operation)) {
            $operation->delete();
        }
        redirect('operations');
	}
	
	private function __set_form_validation_rules($operation_id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', 'Descripcion', 'required');
        $this->form_validation->set_rules('controller', 'Controlador', 'required');
        $this->form_validation->set_rules('parent_operation_id', 'Operacion padre', 'is_natural');
    }
}