<?php namespace App\Controllers;
use App\Models\CajaModel;
use App\Models\DetalleCajaModel;
class ConfiguracionCaja extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$caja=new CajaModel;
			$DetalleCajaModel=new DetalleCajaModel;
			$data= array('cajas' =>$caja->getCaja(),'cajeros'=>$caja->getCajeros(),'comprobantes'=>$caja->getComprobante(),'detalle_caja'=>$DetalleCajaModel->getDetalleCaja());
			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('caja/configuracion.php',$data);
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
	public function updateConfig(){
		$CajaModel=new CajaModel;
		$DetalleCajaModel=new DetalleCajaModel;
		$request= \Config\Services::request();
		$idcaja=$request->getPost("idcaja_config");
		$caja_config=$request->getPost("caja_config");
		$id_cajero=$request->getPost("cajero");
		$id_comprobante=$request->getPost("id_comprobante");
		$serie=$request->getPost("serie");
		$correlativo=$request->getPost("correlativo");
		$igv=$request->getPost("igv");
		$data=array("descripcion"=>$caja_config,
						"id_usuario"=>$id_cajero);
		$CajaModel->update($idcaja,$data);
		$DetalleCajaModel->delete_detalle_caja($idcaja);
		$this->addDetalle_comprobante($id_comprobante,$serie,$correlativo,$igv, intval($idcaja));

	}	
		protected function addDetalle_comprobante($id_comprobante,$serie,$correlativo,$igv,$idcaja){
			$DetalleCajaModel=new DetalleCajaModel;
			for ($i=0; $i < count($id_comprobante) ; $i++) { 
				$data =array(
							'idcaja'=>$idcaja,
							'idcomprobante'=>$id_comprobante[$i],
							'serie'=>$serie[$i],
							'correlativo'=>$correlativo[$i],
							'igv'=>$igv[$i],
					);
				
				$DetalleCajaModel->insert($data);
				
			}

		}

}
