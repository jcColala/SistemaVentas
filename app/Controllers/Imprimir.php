<?php 
class Imprimir extends CI_Controller{
	public function __construct(){
	 parent::__construct();
	 $this->load->model('Inicio_model');
	
	}
	public function comision(){

		$id_comision=$_REQUEST['idc'];
		$comision=$this->Inicio_model->da_comision_imprimir($id_comision);
		$actividad=$this->Inicio_model->da_actividad_imprimir($id_comision);
		$data= array('id_comi'=>$id_comision ,'Nombre_c'=>$comision['Nombre_Comision'],'reso'=>$comision['Resolucion'],'desde'=>$actividad['Desde'],'hasta'=>$actividad['Hasta']);
	
		$this->load->view('registrar_seguimiento/imprimir_datos_comision',$data);
		 
	}
	public function docente(){

		$id_docente=$_REQUEST['idd'];
		$fecha=date("Y-m-d");
		$docente=$this->Inicio_model->da_comision_imprimir_docente($id_docente);
		$data= array('idd'=>$id_docente,'Nombre_d'=>$docente['Nombre_Docente'],'Apellido_d'=>$docente['Apellido_Docente'],'fecha'=>$fecha);
	
		$this->load->view('registrar_docentes/imprimir_datos_docente',$data);
		 
	}

}