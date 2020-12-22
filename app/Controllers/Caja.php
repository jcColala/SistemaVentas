<?php namespace App\Controllers;
use App\Models\CajaModel;
class Caja extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$caja=new CajaModel;
			$data= array('cajas' =>$caja->getCaja(),'cajeros'=>$caja->getCajeros());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('caja/inicio_caja.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function add(){
			$CajaModel=new CajaModel;
			$request= \Config\Services::request();
			$data=array("monto"=>$request->getPost("monto"),
						"id_usuario"=>$request->getPost("cajero"),
						"deleted_at"=>'2020-12-01');
			$CajaModel->update(1,$data);
			return redirect()->to(site_url("Caja"));
			
		}
	public function cerrar(){
			$CajaModel=new CajaModel;
			$request= \Config\Services::request();
			$data=array("monto"=>0,
						"deleted_at"=>null);
			$CajaModel->update(1,$data);
			return redirect()->to(site_url("Caja"));
			
		}	

}
