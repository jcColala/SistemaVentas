<?php namespace App\Controllers;
use App\Models\VentaModel;
use App\Models\CajaModel;
class FacturadorController extends BaseController
{ 
	public function index(){
		$request=\Config\Services::request();
		$VentaModel=new VentaModel;
		$CajaModel=new CajaModel;
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$data= array('ventas' =>$VentaModel->GetVenta(),'caja'=>$CajaModel->getCaja());
			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('ventas/listadofacturacion.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	
	public function enviarsunat(){
			
    	

	}
	
}
