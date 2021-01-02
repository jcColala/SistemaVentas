<?php namespace App\Controllers;
use App\Models\CajaModel;
use App\Models\DetalleCajaModel;
use App\Models\ClienteModel;
use App\Models\ProductoModel;
use App\Models\VentaModel;
use App\Models\DetalleVentaModel;

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

	public function getProducto(){
		$ProductoModel=new ProductoModel;
		$request=\Config\Services::request();
		$valor=$request->getPostGet("valor");
		$producto=$ProductoModel->getProductoVenta($valor);
		echo json_encode($producto);
	}

	public function procesarVenta(){
		$request=\Config\Services::request();
		$ClienteModel=new ClienteModel;
		$VentaModel=new VentaModel;
		$DetalleVentaModel=new DetalleVentaModel;
		$fecha=$request->getPostGet("fecha_venta");
		$docCliente=$request->getPostGet("doc_venta");
		$nombreRazon=$request->getPostGet("n_venta");
		$apellido=$request->getPostGet("a_venta");
		$direccion=$request->getPostGet("direccion_venta");
		$idusuario=$_SESSION['id'];
		$idcomprobante=$request->getPostGet("id_comprobante");
		$correlativo=$request->getPostGet("correlativo_venta");
		$serie=$request->getPostGet("serie_venta");
		$igv=$request->getPostGet("igv_venta");
		$descuento=$request->getPostGet("descuento_venta");
		$id_producto=$request->getPostGet("id_prod");
		$cantidad=$request->getPostGet("cantida_pro");
		$importe=$request->getPostGet("sub_total");
		$precioventa=$request->getPostGet("precioVenta");
		$totalVenta=$request->getPostGet("total_venta");
		$iddetalle_comprobante=$request->getPostGet("iddetalle_comprobante");
		$estadoCliente=$ClienteModel->getclienteDni($docCliente);
		if(strlen($docCliente)>8){
			$tipocliente=1;
		}else{
			$tipocliente=2;
		}
		if($estadoCliente!=false){	
			$data=[
				"nombre"=>$nombreRazon,
				"apellido"=>$apellido,
				"direccion"=>$direccion,
				"idtipo_cliente"=>$tipocliente
			];		 
			$idcliente=$estadoCliente->id_cliente;
			$ClienteModel->update($idcliente, $data);	
		}else{
			$data=[
				"dni_ruc"=>$docCliente,
				"nombre"=>$nombreRazon,
				"apellido"=>$apellido,
				"direccion"=>$direccion,
				"idtipo_cliente"=>$tipocliente
			];
			$ClienteModel->insert($data);
			$idcliente=$ClienteModel->recogerid();
		};
		$dataVenta=array('id_cliente'=>$idcliente,
					 'id_usuario'=>$idusuario,
					 'id_comprobante'=>$idcomprobante,
					 'correlativo'=>$correlativo,
					 'serie'=>$serie,
					 'igv'=>$igv,
					 'descuento'=>$descuento,
					 'totalventa'=>$totalVenta,);	
		
		if($VentaModel->insert($dataVenta)){
			$idVenta=$VentaModel->recogerid($idcomprobante,);
			$this->actualizar_comprobante($iddetalle_comprobante);
			$this->detalleventa($idVenta,$id_producto,$cantidad,$importe,$precioventa);
		}
	}
	protected function detalleventa($idVenta,$id_producto,$cantidad,$importe,$precioventa){
		$DetalleVentaModel=new DetalleVentaModel;
			for ($i=0; $i < count($id_producto) ; $i++) { 
				$data =array(
							'id_venta'=>$idVenta,
							'id_producto'=>$id_producto[$i],
							'cantidad'=>$cantidad[$i],
							'importe'=>$importe[$i],
							'precio_venta'=>$precioventa[$i],
					);
				$DetalleVentaModel->insert($data);
				$this->stock($id_producto[$i],$cantidad[$i]);
				
			}

		}
		protected function stock($id,$cantidad){
		$ProductoModel=new ProductoModel;	
		$query=$ProductoModel->taer($id);
		$dato =array('Stock'=>(int)$query->Stock - (int)$cantidad);
		$ProductoModel->update($id,$dato);

	}
		protected function actualizar_comprobante($iddetalle_comprobante){
			$DetalleCajaModel=new DetalleCajaModel;
			$comprobante_Actual=$DetalleCajaModel->getcomprobante($iddetalle_comprobante);
			$data=array('correlativo'=>(int)$comprobante_Actual->correlativo + 1,);
			$DetalleCajaModel->update($iddetalle_comprobante,$data);


	}
	
}
