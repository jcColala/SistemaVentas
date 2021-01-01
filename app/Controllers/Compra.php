<?php namespace App\Controllers;
use App\Models\CompraModel;
class Compra extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$compra=new CompraModel;
			$data= array('compra' =>$compra->mostrar());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('compras/compra.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function agregarViews(){
		$compra=new CompraModel;
		$request=\Config\Services::request();

		if (!base64_decode($request->getPostGet("id"))){
			$data=array(
				"id"=>'',
				"numero"=>'',
				"serie"=>'',
				"idcompro"=>'',
				"idproveedor"=>'',
				"comprobante"=>'',
				"producto"=>$compra->producto(),
				"proveedor"=>$compra->proveedor()
			);
		}
		else{
			$id=base64_decode($request->getPostGet("id"));
			$traer=$marca->taer($id);
			$data=array(
				"id"=>'',
				"numero"=>'',
				"serie"=>'',
				"idcompro"=>'',
				"comprobante"=>''
			); 
		}

		echo view('main/header.php');
	    echo view('main/menu.php');
	    echo view('compras/compra_add.php',$data);
	    echo view('main/footer.php'); 
	}
	public function agregar(){
		$compra=new CompraModel;
		$request=\Config\Services::request();
		$session = \Config\Services::session();

		$lista = $_REQUEST['data_detalle'];
		$lista = json_decode($lista);
		$data= [
			'IdProveedor' => $_POST['idprovedor'],
			'IdUsuario' => $session->get('id'),
			'Comprobante' => $_POST['compro'],
			'SerieComprobante' => $_POST['serie'],
			'NumComprobante' => $_POST['numero'],
			'Fecha' => date("Y-m-d"),
			'Importe' => $_POST['totalC']
		];
		$compra->insert($data);
		$idcompra=$compra->idcompra();
		$idcompra=$idcompra->Id;

		foreach($lista  as $val){
			$subtotal = $val->cant*$val->precioc;
			$compra->insertar_detalle($idcompra,$val->id,$val->cant,$val->precioc,$subtotal);
			$compra->cambio_stock($val->id,$val->cant);
		}
		echo json_encode('Insertada');

	}
	public function activar_eliminar(){
		/*$request=\Config\Services::request();
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
		}*/
	}
}