<?php namespace App\Controllers;
use App\Models\LoginModel;
class Login extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')!=NULL){
			return redirect()->to(site_url("Inicio"));
		}
		else{
			echo view('main/login.php');
		}
	}  

	public function verificar(){
		$request=\Config\Services::request();
		$session = \Config\Services::session();

		$login=new LoginModel;
		$usuario=$request->getPostGet("usuario");
		$pasword=$request->getPostGet("pasword");

		$traer=$login->verificar($usuario,$pasword);
		if (!$traer) {return redirect()->to(site_url("Login"));}
		else{
			$datasesion = [
					'id'=>$traer->Id,
					'tipo'=>$traer->Id_Tipo,
					'dni'=>$traer->DNI,
					'nombre'=>$traer->Nombre,
					'login'=> True
				 ];
			$session->set($datasesion);
			return redirect()->to(site_url("Inicio"));
		}

	}
	public function salir(){
		$session = \Config\Services::session();
		$session->destroy();
		return redirect()->to(site_url("Login"));
	}

}
/*
<?php
class Login extends CI_Controller{
  public function __construct(){
	 parent::__construct();
	 $this->load->model('Login_model'); 
	}
	public function index(){
		if($this->session->userdata("login")){
			redirect(base_url()."Inicio");
		}
		else{
			$this->load->view('login/login');
		}
	}
	public function verificar_usuario(){
		$usuario=$this->input->post("usuario");
		$pasword=$this->input->post("pasword");
		$traer=$this->Login_model->verificar_usuario($usuario,$pasword);
		if ($traer!=0) {
					$arrray_sesion = array(
					'id'=>$traer["Id"],
					'tipo'=>$traer["Id_Tipo"],
					'dni'=>$traer["DNI"],
					'nombre'=>$traer["Nombre"],
					'login'=> True
				 );
				 $this->session->set_userdata($arrray_sesion);
		}
		echo json_encode($traer);
	}
	public function salir(){
		session_destroy();
		redirect(base_url());
	}
}
*/