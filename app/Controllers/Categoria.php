<?php namespace App\Controllers;
use App\Models\CategoriaModel;
class Categoria extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$categoria=new CategoriaModel;
			$data= array('categoria' =>$categoria->mostrar());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('almacen/categoria.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function agregarViews(){
		$categoria=new CategoriaModel;
		$request=\Config\Services::request();

		if (!base64_decode($request->getPostGet("id"))){
			$data=array(
				"id"=>'',
				"descripcion"=>''
			);
		}
		else{
			$id=base64_decode($request->getPostGet("id"));
			$traer=$categoria->taer($id);
			$data=array(
				"id"=>$traer->Id,
				"descripcion"=>$traer->Descripcion
			); 
		}

		echo view('main/header.php');
	    echo view('main/menu.php');
	    echo view('almacen/categoria_add.php',$data);
	    echo view('main/footer.php'); 
	}
	public function agregar(){
		$categoria=new CategoriaModel;
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
			if($categoria->compro_d($request->getPostGet("descripcion")) == false){
				$alert="¡ La categoria ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}
			$categoria->insert($data);
		}
		else{
			/*if($categoria->compro_d2($request->getPostGet("descripcion"),$request->getPostGet("id")) == false){
				$alert="¡ La descripción ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}*/ 
			$categoria->update($id, $data);
		}
		return redirect()->to(site_url("Categoria"));

	}
	public function activar_eliminar(){
		$request=\Config\Services::request();
		$categoria=new CategoriaModel;
		$id=$request->getPostGet('id');
		$op=$request->getPostGet('op');
		if ($op=='activar') {
			$data = [
			    'deleted_at' => NULL,
			];
			$categoria->update($id, $data);
			echo json_encode('activo');
		}
		else{
			$categoria->delete($id);
			echo json_encode('elimino');
		}
	}
}