<?php
/*
 * Created on Nov 18, 2011
 *
 * @author Sergio Morales López
 */
 
class folders extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index() {
        redirect('/folders/listing/');
    }
	
	public function listing($folder_id = FALSE){
		$this->data['folders'] = Doctrine_Query::create()->select('u.*')->from('folder u')->execute();
		$this->load->view('/folders/list', $this->data);
	}
	
	public function insert($folder_id = FALSE){
		$this->data['folder'] = ($folder_id) ? Doctrine::getTable('folder')->findOneBy('folder_id', $folder_id) : new folder();
        if (!is_object($this->data['folder']))
            $this->data['folder'] = new folder();

        $this->__set_form_validation_rules($folder_id);

        if ($this->form_validation->run() == FALSE) {
            $this->data['form_errors'] = validation_errors();
            
            $options = array();
            $folders = Doctrine_Query::create()->select('f.*')->from('folder as f')->execute();
            foreach ($folders as $folder)
            	$options[$folder->folder_id] = $folder->description;
            $this->data['options'] = $options;
            
            $this->load->view('/folders/add_form', $this->data);
        } else {
            $this->data['folder']->description			= $this->input->post('description', true);
            $this->data['folder']->folder_padre_id		= $this->input->post('folder_padre_id', true);
            $this->data['folder']->save();
            redirect('folders');
        }
	}
	
	public function delete($folder_id){
		$folder = new folder();
        $folder = $folder->getTable()->findOneBy('folder_id', $folder_id);
        
        if (is_object($folder)) {
            $folder->delete();
        }
        redirect('folders');
	}
	
	public function tree(){
		$this->data['folders'] = Doctrine_Query::create()->select('f.*')->from('folder f')->where('folder_padre_id = 0')->execute();
		//if (!is_object($this->data['operations']))
		$this->load->view('/folders/tree', $this->data);
	}
	
	private function __set_form_validation_rules($folder_id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', 'Descripcion', 'required');
        $this->form_validation->set_rules('folder_padre_id', 'Folder padre', 'is_natural');
    }
}