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
			$data= array('usuario' =>$usuario->mostrar());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('usuario/usuario.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function agregarViews(){
		$usuario=new UsuarioModel;
		$request=\Config\Services::request();

		if (!base64_decode($request->getPostGet("id"))){
			$data=array(
				"id"=>'',
				"nombre"=>'',
				"apellidos"=>'',
				"dni"=>'',
				"usuario"=>'',
				"clave"=>'',
				"mtipo"=>'',
				"correo"=>'',
				"celular"=>'',
				"sexo"=>'',
				"direccion"=>'',
				"fechaN"=>'',
				"fechaI"=>'',
				"tipo"=>$usuario->mostrar_tipo()
			);
		}
		else{
			$id=base64_decode($request->getPostGet("id"));
			$traer=$usuario->taer($id);
			$data=array(
				"id"=>$traer->Id,
				"nombre"=>$traer->Nombre,
				"apellidos"=>$traer->Apellidos,
				"dni"=>$traer->DNI,
				"usuario"=>$traer->Login,
				"clave"=>$traer->Clave,
				"mtipo"=>$traer->Id_Tipo,
				"correo"=>$traer->Correo,
				"celular"=>$traer->Celular,
				"sexo"=>$traer->Sexo,
				"direccion"=>$traer->Direccion,
				"fechaN"=>$traer->Fecha_Nacimiento,
				"fechaI"=>$traer->Fecha_Ingreso,
				"tipo"=>$usuario->mostrar_tipo()
			); 
		}

		echo view('main/header.php');
	    echo view('main/menu.php');
	    echo view('usuario/usuario_dd.php',$data);
	    echo view('main/footer.php'); 
	}
	public function agregar(){
		$usuario=new UsuarioModel;
		$request=\Config\Services::request();
		$id=$request->getPostGet("id");
		$data=[
				'Id_Tipo'=> $request->getPostGet("mtipo"),
				'Nombre'=> $request->getPostGet("nombre"),
				'Apellidos'=> $request->getPostGet("apellidos"),
				'DNI' => $request->getPostGet("dni"),
				'Celular'=> $request->getPostGet("celular"),
				'Correo'=> $request->getPostGet("correo"),
				'Direccion'=> $request->getPostGet("direccion"),
				'Sexo'=> $request->getPostGet("sexo"),
				'Estado_Civil'=>'',
				'Fecha_Nacimiento'=> $request->getPostGet("fechaN"),
				'Fecha_Ingreso'=> $request->getPostGet("fechaI"),
				'Login'=> $request->getPostGet("usuario"),
				'Clave'=> $request->getPostGet("clave"),
				'Nombre_Foto'=>""
		];
		if ($request->getPostGet("nombre")=='' or $request->getPostGet("apellidos")=='' or $request->getPostGet("dni")=='' or $request->getPostGet("usuario")=='' or $request->getPostGet("clave")=='' or $request->getPostGet("mtipo")=='') {
				$alert="Es necesario ingresar nombre, apellidos, DNI, usuario, clave y tipo, son campos obligatorios";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
		}
		if (strlen($request->getPostGet("dni"))!=8) {
				$alert="Ingrese un DNI correcto";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
		}
		if ($id=='') {
			if($usuario->compro_dni($request->getPostGet("dni")) == false){
				$alert="¡ El DNI ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}
			if($usuario->compro_u($request->getPostGet("usuario")) == false){
				$alert="¡ Usuario ya existente, escoge otro nombre con el cual loguearte !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}
			$usuario->insert($data);
		}
		else{ $usuario->update($id, $data);}
		return redirect()->to(site_url("Usuario"));

	}
	public function activar_eliminar(){
		$request=\Config\Services::request();
		$usuario=new UsuarioModel;
		$id=$request->getPostGet('id');
		$op=$request->getPostGet('op');
		if ($op=='activar') {
			$data = [
			    'deleted_at' => NULL,
			];
			$usuario->update($id, $data);
			echo json_encode('activado');
		}
		else{
			$usuario->delete($id);
			echo json_encode('eliminado');
		}
	}
}