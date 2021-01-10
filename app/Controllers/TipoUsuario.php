<?php namespace App\Controllers;
use App\Models\TipoUsuarioModel;
class TipoUsuario extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$t_usuario=new TipoUsuarioModel;
			$data= array('t_usuario' =>$t_usuario->mostrar());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('usuario/t_usuario.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function agregarViews(){
		$t_usuario=new TipoUsuarioModel;
		$request=\Config\Services::request();

		if (!base64_decode($request->getPostGet("id"))){
			$data=array(
				"id"=>'',
				"descripcion"=>''
			);
		}
		else{
			$id=base64_decode($request->getPostGet("id"));
			$traer=$t_usuario->taer($id);
			$data=array(
				"id"=>$traer->Id,
				"descripcion"=>$traer->Descripcion
			); 
		}

		echo view('main/header.php');
	    echo view('main/menu.php');
	    echo view('usuario/t_usuario_dd.php',$data);
	    echo view('main/footer.php'); 
	}
	public function agregar(){
		$t_usuario=new TipoUsuarioModel;
		$request=\Config\Services::request();
		$id=$request->getPostGet("id");
		$data=[
				'Descripcion'=> $request->getPostGet("descripcion")
		];
		if ($request->getPostGet("descripcion")=='') {
				$alert="Es necesario ingresar la descripción";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
		}
		if ($id=='') {
			if($t_usuario->compro_d($request->getPostGet("descripcion")) == false){
				$alert="¡ El Tipo usuario ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}
			$t_usuario->insert($data);
		}
		else{
			if($t_usuario->compro_d_update($request->getPostGet("descripcion"),$id) == false){
				$alert="¡ El Tipo usuario ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}
			$t_usuario->update($id, $data);}
		return redirect()->to(site_url("TipoUsuario"));

	}
	public function activar_eliminar(){
		$request=\Config\Services::request();
		$t_usuario=new TipoUsuarioModel;
		$id=$request->getPostGet('id');
		$op=$request->getPostGet('op');
		if ($op=='activar') {
			$data = [
			    'deleted_at' => NULL,
			];
			$t_usuario->update($id, $data);
			echo json_encode('activado');
		}
		else{
			$t_usuario->delete($id);
			echo json_encode('eliminado');
		}
	}
}