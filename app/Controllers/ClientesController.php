<?php namespace App\Controllers;
use App\Models\ClienteModel;
class ClientesController extends BaseController
{ 
	public function index(){ 
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$cliente=new ClienteModel;
			$data= array('clientes' =>$cliente->getCliente());
			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('cliente/listado_cliente.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function agregarViews(){
		$cliente=new ClienteModel;
		$request=\Config\Services::request();
		$id=base64_decode($request->getPostGet("id"));	
		if (!base64_decode($request->getPostGet("id"))){
			$data=array(
				"id_cliente"=>'',
				"dni_ruc"=>'',
				"nombre"=>'',
				"apellido"=>'',
				"telefono"=>'',
				"correo"=>'',
				"direccion"=>'',
				"sexo"=>'',
				"tipo_cliente"=>'',
				"idtipo_cliente"=>$cliente->getTipo()
			);
		}
		else{
			$id=base64_decode($request->getPostGet("id"));
			$traer=$cliente->getClienteU($id);
			$data=array(
				"id_cliente"=>$traer->id_cliente,
				"dni_ruc"=>$traer->dni_ruc,
				"nombre"=>$traer->nombre,
				"apellido"=>$traer->apellido,
				"telefono"=>$traer->telefono,
				"correo"=>$traer->correo,
				"direccion"=>$traer->direccion,
				"sexo"=>$traer->sexo,
				"tipo_cliente"=>$traer->idtipo_cliente,
				"idtipo_cliente"=>$cliente->getTipo()
			); 
		}

		echo view('main/header.php');
	    echo view('main/menu.php');
	    echo view('cliente/cliente_add.php',$data);
	    echo view('main/footer.php'); 
	}
	public function agregar(){
		$cliente=new ClienteModel;
		$request=\Config\Services::request();
		$id=$request->getPostGet("id_cliente");
		$data=[
				"dni_ruc"=>$request->getPostGet("dni_cliente"),
				"nombre"=>$request->getPostGet("nombre_cliente"),
				"apellido"=>$request->getPostGet("apellidos_cliente"),
				"telefono"=>$request->getPostGet("celular_cliente"),
				"correo"=>$request->getPostGet("correo_cliente"),
				"direccion"=>$request->getPostGet("direccion_cliente"),
				"sexo"=>$request->getPostGet("sexo_cliente"),
				"idtipo_cliente"=>$request->getPostGet("tipo_cliente"),
		];
		
		
		if ($id=='') {
			if($cliente->compro_dni($request->getPostGet("dni_cliente")) == false){
				$alert="¡ El DNI ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}
			$cliente->insert($data);
			$alert_ingreso_cliente="<div class='card-body'><div class='alert alert-success' role='alert'>
        				El Registro se ingresó con ÉXITO
        				</div></div>";
        	$this->session->setFlashdata('alert_ingreso_cliente', $alert_ingreso_cliente);
		}
		else{
			$valor=$cliente->compro_dni2($id,$request->getPostGet("dni_cliente"));
			if( !empty($valor)){
				$alert="¡ El DNI ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			};
			$cliente->update($id, $data); 
			$alert_ingreso_cliente="<div class='card-body'><div class='alert alert-success' role='alert'>
        				El Registro se ingresó con ÉXITO
        				</div></div>";
        	$this->session->setFlashdata('alert_ingreso_cliente', $alert_ingreso_cliente);
			// if($cliente->update($id, $data)==false){
			// 	var_dump($cliente->errors());
			// 	// $alert="¡ El DNI ya existe2 !";
			// 	// $this->session->setFlashdata('alert', $alert);
			// 	// return " <script type='text/javascript'>window.history.back();</script>";
			// };

		}

		 return redirect()->to(site_url("ClientesController"));

	}
	public function activar_eliminar(){
		$request=\Config\Services::request();
		$cliente=new ClienteModel;
		$id=$request->getPostGet('id');
		$op=$request->getPostGet('op');
		if ($op=='A') {
			$data = [
			    'deleted_at' => NULL,
			];
			$cliente->update($id, $data);
			echo json_encode('activado');
		}
		else{
			$cliente->delete($id);
			echo json_encode('eliminado');
		}
	}
}