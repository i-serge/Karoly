<?php
/*
 * Created on Nov 17, 2011
 *
 * @author Sergio Morales López
 */
 
class Users extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index() {
        redirect('/users/listing/');
    }
	
	public function listing($user_id = FALSE){
		$this->data['users'] = Doctrine_Query::create()->select('u.*')->from('user u')->execute();
		$this->load->view('/users/list', $this->data);
	}
	
	public function insert($user_id = FALSE){
		$this->data['user'] = ($user_id) ? Doctrine::getTable('user')->findOneBy('user_id', $user_id) : new User();
        if (!is_object($this->data['user']))
            $this->data['user'] = new User();

        $this->__set_form_validation_rules($user_id);

        if ($this->form_validation->run() == FALSE) {
            $this->data['form_errors'] = validation_errors();
            
            $userTypes = Doctrine_Query::create()->select('ut.*')->from('userType as ut')->execute();
            foreach ($userTypes as $userType)
            	$options[$userType->userType_id] = $userType->description;
            $this->data['options'] = $options;
            
            $this->load->view('/users/add_form', $this->data);
        } else {
            $this->data['user']->name			= $this->input->post('name', true);
            $this->data['user']->lastname		= $this->input->post('lastname', true);
            $this->data['user']->slastname		= $this->input->post('slastname', true);
            $this->data['user']->email			= $this->input->post('email', true);
            $this->data['user']->password		= $this->input->post('password', true);
            $this->data['user']->telephone		= $this->input->post('telephone', true);
            $this->data['user']->userType_id	= $this->input->post('userType_id', true);
            $this->data['user']->save();
            redirect('users');
        }
	}
	
	public function delete($user_id){
		$user = new User();
        $user = $user->getTable()->findOneBy('user_id', $user_id);
        
        if (is_object($user)) {
            $user->delete();
        }
        redirect('users');
	}
	
	private function __set_form_validation_rules($user_id) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nombre', 'required');
        $this->form_validation->set_rules('lastname', 'Apellido Paterno', 'required');
        $this->form_validation->set_rules('slastname', 'Apellido Materno', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Contrasena', 'required|alpha_dash|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirmar contrasena', 'required|matches[password]');
        $this->form_validation->set_rules('telephone', 'Telefono', '');
        $this->form_validation->set_rules('userType_id', 'Tipo de usuario', 'required|is_natural');
    }
}