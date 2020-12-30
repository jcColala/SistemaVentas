<?php namespace App\Controllers;
use App\Models\CajaModel;
use App\Models\DetalleCajaModel;
use App\Models\ClienteModel;

class VentasController extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			 $caja=new CajaModel;
			 $DetalleCajaModel=new DetalleCajaModel;
			 $ClienteModel=new ClienteModel;
			 $data= array('clientes' =>$ClienteModel->getCliente(),'cajeros'=>$caja->getCajeros(),'comprobantes'=>$DetalleCajaModel->getDetalleCaja());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('ventas/facturacion.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	
}
