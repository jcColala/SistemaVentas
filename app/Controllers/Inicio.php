<?php namespace App\Controllers;
use App\Models\InicioModel;
class Inicio extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$data = array();
	        echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('main/footer.php');
    	}
	}
}
