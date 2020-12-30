<?php namespace App\Controllers;

class ListadoVentasController extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			
			// $data= array('cajas' =>$caja->getCaja(),'cajeros'=>$caja->getCajeros(),'comprobantes'=>$caja->getComprobante(),'detalle_caja'=>$DetalleCajaModel->getDetalleCaja());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('ventas/facturacion.php');
	        echo view('main/footer.php'); 
    	}
	}
	
}
