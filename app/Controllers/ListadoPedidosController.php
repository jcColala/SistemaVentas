<?php namespace App\Controllers;
use App\Models\PedidosModel;
use App\Models\CajaModel;
use App\Models\DetalleCajaModel;
use App\Models\ClienteModel;
use App\Models\ProductoModel;
use App\Models\DetallePedidoModel;
class ListadoPedidosController extends BaseController
{ 
	public function index(){
		$request=\Config\Services::request();
		$PedidosModel=new PedidosModel;
		$CajaModel=new CajaModel;
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		}
		else{
			$data= array('pedidos' =>$PedidosModel->getpedido(),'caja'=>$CajaModel->getCaja());
			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('pedidos/listado.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function getPedidoU(){
		$PedidosModel=new PedidosModel;
		$request=\Config\Services::request();
		$id=$request->getPostGet("id");
		$data= array('pedidoU' =>$PedidosModel->getPedidoU($id),
					 'detallepedidoU' =>$PedidosModel->getdetallePedido($id));
		echo view('pedidos/modelpedido.php',$data);
	}
	public function VentasProcesadas(){
			$PedidosModel=new PedidosModel;
			$data= array('ventas' =>$PedidosModel->GetVenta());
			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('ventas/procesadas.php',$data);
	        echo view('main/footer.php'); 
    	

	}
	public function procesarPedido(){
		$request=\Config\Services::request();
		$ClienteModel=new ClienteModel;
		$PedidosModel=new PedidosModel;
		$fecha=$request->getPostGet("fecha_venta");
		$docCliente=$request->getPostGet("doc_venta");
		$nombreRazon=$request->getPostGet("nombre_venta");
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
		$nombre_venta=$request->getPostGet("nombre_venta");
		$producto_nombre=$request->getPostGet("producto_nombre");
		$iddetalle_comprobante=$request->getPostGet("iddetalle_comprobante");
		$subtotal=$request->getPostGet("subtotal");
		$estadoCliente=$ClienteModel->getclienteDni($docCliente);
		if(strlen($docCliente)>8){
			$tipocliente=1;
		}else{
			$tipocliente=2;
		}
		if($estadoCliente!=false){	
			$data=[
				"nombre"=>$nombreRazon,
				"direccion"=>$direccion,
				"idtipo_cliente"=>$tipocliente
			];		 
			$idcliente=$estadoCliente->id_cliente;
			$ClienteModel->update($idcliente, $data);	
		}else{
			$data=[
				"dni_ruc"=>$docCliente,
				"nombre"=>$nombreRazon,
				"direccion"=>$direccion,
				"idtipo_cliente"=>$tipocliente
			];
			$ClienteModel->insert($data);
			$idcliente=$ClienteModel->recogerid();
		};
		$datapedido=array('id_cliente'=>$idcliente,
					 'id_usuario'=>$idusuario,
					 'id_comprobante'=>$idcomprobante,
					 'serie'=>$serie,
					 'igv'=>$igv,
					 'subtotal'=>$subtotal,
					 'descuento'=>$descuento,
					 'totalventa'=>$totalVenta,);	
		


		if($PedidosModel->insert($datapedido)){
			$idPedido=$PedidosModel->recogerid();
			
			$this->detallepedido($idPedido,$id_producto,$cantidad,$importe,$precioventa);
		}
		
	
		// $sessionidventa = [
		// 			'idVenta'=>$idVenta,
		// 		 ];
		// 	$session->set($sessionidventa);
	}
	protected function detallepedido($idPedido,$id_producto,$cantidad,$importe,$precioventa){
		$DetallePedidoModel=new DetallePedidoModel;
			for ($i=0; $i < count($id_producto) ; $i++) { 
				$data =array(
							'id_pedido'=>$idPedido,
							'id_producto'=>$id_producto[$i],
							'cantidad'=>$cantidad[$i],
							'importe'=>$importe[$i],
							'precio_venta'=>$precioventa[$i],
					);
				$DetallePedidoModel->insert($data);
				$this->stock($id_producto[$i],$cantidad[$i]);
				
			}

		}
	protected function stock($id,$cantidad){
		$ProductoModel=new ProductoModel;	
		$query=$ProductoModel->taer($id);
		$dato =array('Stock'=>(int)$query->Stock - (int)$cantidad);
		$ProductoModel->update($id,$dato);

	}	
	public function eliminarpedido(){
    	$ProductoModel=new ProductoModel;	
    	$DetallePedidoModel=new DetallePedidoModel;
    	$PedidosModel=new PedidosModel;
		$request=\Config\Services::request();
		$id=$request->getPostGet("id");
		$ventaU =$PedidosModel->getPedidoU($id);
		$data=[
				"deleted_at"=>2,
			];		 
		$PedidosModel->update($id, $data);
		
		$detallepedidoU =$PedidosModel->getdetallePedido($id);
		foreach ( $detallepedidoU as $row) {
			$idproductoPedido=$row->id_producto;
			$query=$ProductoModel->taer($idproductoPedido);
			$cantidadactual=$query->Stock;
			$cantidadventa=$row->cantidad;
			$cantidadactualizada=$cantidadactual+$cantidadventa;
			$dataproducto=[
				"Stock"=>$cantidadactualizada,
			];	
			$ProductoModel->update($idproductoPedido, $dataproducto);
		}

    }
}
