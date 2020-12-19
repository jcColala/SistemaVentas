<?php namespace App\Controllers;
use App\Models\UsuarioModel;
class Usuario extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$usuario=new UsuarioModel;
			$data= array('usuario' =>$usuario->mostrar(),'tipo'=>$usuario->mostrar_tipo());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('usuario/usuario.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
}