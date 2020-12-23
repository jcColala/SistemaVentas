<?php namespace App\Controllers;
use App\Models\MarcaModel;
class Marca extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$marca=new MarcaModel;
			$data= array('marca' =>$marca->mostrar());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('almacen/marca.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function agregarViews(){
		$marca=new MarcaModel;
		$request=\Config\Services::request();

		if (!base64_decode($request->getPostGet("id"))){
			$data=array(
				"id"=>'',
				"descripcion"=>''
			);
		}
		else{
			$id=base64_decode($request->getPostGet("id"));
			$traer=$marca->taer($id);
			$data=array(
				"id"=>$traer->Id,
				"descripcion"=>$traer->Descripcion
			); 
		}

		echo view('main/header.php');
	    echo view('main/menu.php');
	    echo view('almacen/marca_add.php',$data);
	    echo view('main/footer.php'); 
	}
	public function agregar(){
		$marca=new MarcaModel;
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
			if($marca->compro_d($request->getPostGet("descripcion")) == false){
				$alert="¡ La marca ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}
			$marca->insert($data);
		}
		else{
			/*if($categoria->compro_d2($request->getPostGet("descripcion"),$request->getPostGet("id")) == false){
				$alert="¡ La descripción ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}*/ 
			$marca->update($id, $data);
		}
		return redirect()->to(site_url("Marca"));

	}
	public function activar_eliminar(){
		$request=\Config\Services::request();
		$marca=new MarcaModel;
		$id=$request->getPostGet('id');
		$op=$request->getPostGet('op');
		if ($op=='activar') {
			$data = [
			    'deleted_at' => NULL,
			];
			$marca->update($id, $data);
			echo json_encode('activo');
		}
		else{
			$marca->delete($id);
			echo json_encode('elimino');
		}
	}
}