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
	public function agregarViews(){
		$usuario=new UsuarioModel;
		$request=\Config\Services::request();

		if (!$request->getPostGet("id")){
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
			$id=$request->getPostGet("id");
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
		$usuario->insert($data);

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
		}
		else{
			$usuario->delete($id);
		}
		echo json_encode($op);
	}
}