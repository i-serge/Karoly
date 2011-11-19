<?php 

class Login extends CI_Controller{
	
	public function index(){
		$this->load->view('login');
	}
	
	public function buscar() {
		$query_user = Doctrine_Core::getTable('user')->findOneBy('email',$_POST['email']);
		if(is_object($query_user)){
			if($query_user->password==$_POST['password'])
				echo "bienvenido";
			else
				echo "error , no encontrado0";
		}
	}
}
	
?>