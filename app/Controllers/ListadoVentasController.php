<?php namespace App\Controllers;
use App\Models\VentaModel;
class ListadoVentasController extends BaseController
{ 
	public function index(){
		$request=\Config\Services::request();
		$VentaModel=new VentaModel;
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$data= array('ventas' =>$VentaModel->GetVenta());
			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('ventas/listado.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function getventaU(){
		$VentaModel=new VentaModel;
		$request=\Config\Services::request();
		$id=$request->getPostGet("id");
		$data= array('ventaU' =>$VentaModel->GetVentaU($id),
					 'detalleVentaU' =>$VentaModel->getdetalleVenta($id));
		echo view('ventas/modelventa.php',$data);
	}
	public function VentasProcesadas(){
			$VentaModel=new VentaModel;
			$data= array('ventas' =>$VentaModel->GetVenta());
			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('ventas/procesadas.php',$data);
	        echo view('main/footer.php'); 
    	

	}
	
}
