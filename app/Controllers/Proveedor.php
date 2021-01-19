<?php namespace App\Controllers;
use App\Models\ProveedorModel;
class Proveedor extends BaseController
{ 
	public function index(){ 
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		} 
		else{
			$proveedor=new ProveedorModel;
			$data= array('proveedor' =>$proveedor->mostrar());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('compras/proveedor.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function agregarViews(){
		$proveedor=new ProveedorModel;
		$request=\Config\Services::request();

		if (isset($_GET['com'])) { $compra='1';}else{$compra="0";}

		if (!base64_decode($request->getPostGet("id"))){
			$data=array(
				"id"=>'',
				"nombre"=>'',
				"dni_ruc"=>'',
				"celular"=>'',
				"telefono"=>'',
				"correo"=>'',
				"direccion"=>'',
				"compra"=>$compra
			);
		}
		else{
			$id=base64_decode($request->getPostGet("id"));
			$traer=$proveedor->taer($id);
			$data=array(
				"id"=>$traer->Id,
				"nombre"=>$traer->Nombre,
				"dni_ruc"=>$traer->DNI_RUC,
				"celular"=>$traer->Celular,
				"telefono"=>$traer->Telefono,
				"correo"=>$traer->Correo,
				"direccion"=>$traer->Direccion,
				"compra"=>$compra
			); 
		}

		echo view('main/header.php');
	    echo view('main/menu.php');
	    echo view('compras/proveedor_dd.php',$data);
	    echo view('main/footer.php'); 
	}
	public function agregar(){
		$proveedor=new ProveedorModel;
		$request=\Config\Services::request();
		$id=$request->getPostGet("id");
		$compra=$request->getPostGet("compra");
		$data=[
				'Nombre'=> $request->getPostGet("nombre"),
				'DNI_RUC' => $request->getPostGet("dni_ruc"),
				'Celular'=> $request->getPostGet("celular"),
				'Telefono'=> $request->getPostGet("telefono"),
				'Correo'=> $request->getPostGet("correo"),
				'Direccion'=> $request->getPostGet("direccion")
		];
		if ($request->getPostGet("nombre")=='' or $request->getPostGet("dni_ruc")=='' or $request->getPostGet("correo")=='' or $request->getPostGet("direccion")=='') {
				$alert="Es necesario ingresar el nombre, DNI ó RUC, correo, y dirección, son campos obligatorios";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
		}
		if (strlen($request->getPostGet("dni_ruc"))!=8 and strlen($request->getPostGet("dni_ruc"))!=11) {
				$alert="Ingrese un DNI ó RUC correcto";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
		}
		if (strlen($request->getPostGet("celular"))!=9 and strlen($request->getPostGet("celular"))>0) {
				$alert="Ingrese un numero de celular correcto";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
		}
		if (strlen($request->getPostGet("telefono"))!=9 and strlen($request->getPostGet("telefono"))>0) {
				$alert="Ingrese un numero de telefono correcto";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
		}
		if ($id=='') {
			if($proveedor->compro_dni($request->getPostGet("dni_ruc")) == false){
				$alert="¡ El proveedor ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}
			$proveedor->insert($data);
			if ($compra==1) {
				return " <script type='text/javascript'>window.history.go(-2);</script>";
			}
		}
		else{ $proveedor->update($id, $data);}
		return redirect()->to(site_url("Proveedor"));

	}
	public function activar_eliminar(){
		$request=\Config\Services::request();
		$proveedor=new ProveedorModel;
		$id=$request->getPostGet('id');
		$op=$request->getPostGet('op');
		if ($op=='activar') {
			$data = [
			    'deleted_at' => NULL,
			];
			$proveedor->update($id, $data);
			echo json_encode('activado');
		}
		else{
			$proveedor->delete($id);
			echo json_encode('eliminado');
		}
	}
}