<?php namespace App\Controllers;
use App\Models\CajaModel;
use App\Models\DetalleCajaModel;
use App\Models\ClienteModel;
use App\Models\ProductoModel;
use App\Models\VentaModel;
use App\Models\DetalleVentaModel;
use App\Models\PedidosModel;
use App\Models\DetallePedidoModel;
require 'app/thirdParty/phpqrcode/qrlib.php';
use QRcode\qrstr ;

require_once("app/ThirdParty/vendor/autoload.php");
use Dompdf\Dompdf ;

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
			 $data= array('clientes' =>$ClienteModel->getCliente(),'cajeros'=>$caja->getCajeros(),'comprobantes'=>$DetalleCajaModel->getDetalleCaja(),
				"idtipo_cliente"=>$ClienteModel->getTipo());

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
		$dataVenta=array('id_cliente'=>$idcliente,
					 'id_usuario'=>$idusuario,
					 'id_comprobante'=>$idcomprobante,
					 'serie'=>$serie,
					 'igv'=>$igv,
					 'subtotal'=>$subtotal,
					 'descuento'=>$descuento,
					 'totalventa'=>$totalVenta,);	
		


		if($VentaModel->insert($dataVenta)){
			$idVenta=$VentaModel->recogerid($idcomprobante,);
			
			$this->detalleventa($idVenta,$id_producto,$cantidad,$importe,$precioventa);
		}
		
	
		// $sessionidventa = [
		// 			'idVenta'=>$idVenta,
		// 		 ];
		// 	$session->set($sessionidventa);
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
	public function fpdf() {
		$DetalleVentaModel=new DetalleVentaModel;
		$PedidosModel=new PedidosModel;
		$DetalleCajaModel=new DetalleCajaModel;
		$VentaModel=new VentaModel;
		$request=\Config\Services::request();
		$id=$request->getPostGet("id");
		$idusuario=$_SESSION['id'];
		$pedidoU=$PedidosModel->getPedidoU($id);
		$detallepedidoU=$PedidosModel->getdetallePedido($id);
		$dataventa=["id_cliente"=>$pedidoU->id_cliente,
					"id_usuario"=>$pedidoU->id_usuario,
					"id_comprobante"=>$pedidoU->id_comprobante,
					"serie"=>$pedidoU->serie,
					"igv"=>$pedidoU->igv,
					"descuento"=>$pedidoU->descuento,
					"subtotal"=>$pedidoU->subtotal,
					"totalventa"=>$pedidoU->totalventa];
		$VentaModel->insert($dataventa);
		$idVenta=$VentaModel->recogerid();

		foreach ($detallepedidoU  as  $row) {
				$data =array(
							'id_venta'=>$idVenta,
							'id_producto'=>$row->id_producto,
							'cantidad'=>$row->cantidad,
							'importe'=>$row->importe,
							'precio_venta'=>$row->precio_venta,
					);
				$DetalleVentaModel->insert($data);
		}
		// $dataestadopedido = [
  //  			 'deleted_at' => 1];

		// $PedidosModel->update($id, $dataestadopedido);
		

		$ventadato=$VentaModel->GetVentaU($idVenta);
		$datocomprobante=$DetalleCajaModel->getcomprobante2($ventadato->id_comprobante);
		$correlativo=$datocomprobante->correlativo;
		$iddetalle_comprobante=$datocomprobante->iddetalle_ccomprobante;
		$this->actualizar_comprobante($iddetalle_comprobante);
		$ncorrelativo=$this->generarnumero($correlativo);
		

         $dataestado=[
         	'correlativo'=>$ncorrelativo,
				
			];	
		$baseurl=base_url();		
		$qrcode = new \QRcode;
		$dir=$baseurl."/public/temp/";
		if(!file_exists($dir)){
			mkdir($dir);
		};
		$filename='test3.png';
		$tamanio=10;
		$level='M';
		$frameSize=3;
		$contenido="hola mundo";
		$qrcode->png($contenido,$filename,$level,$tamanio,$frameSize);
		$VentaModel->update($idVenta, $dataestado);
		$data= array('ventaU' =>$VentaModel->GetVentaU($idVenta),
					 'detalleVentaU' =>$VentaModel->getdetalleVenta($idVenta),
					 
					 'baseurl'=>base_url(),'filename'=>$filename
					 );
// instantiate and use the dompdf class
	 // echo view('Imprimir/comprobante.php',$data);
			
		$dompdf = new Dompdf(array('enable_remote' => true));
		$dompdf->set_base_path($baseurl); 
 		$dompdf->loadHtml(view('Imprimir/comprobante.php',$data));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false)); 
    }
    public function FacturarVenta(){
    	$VentaModel=new VentaModel;

		$request=\Config\Services::request();
		if (!base64_decode($request->getPostGet("id"))){

		}
    }
    
   
   public function eliminarventa(){
    	$ProductoModel=new ProductoModel;	
    	$DetalleVentaModel=new DetalleVentaModel;
    	$VentaModel=new VentaModel;
		$request=\Config\Services::request();
		$id=$request->getPostGet("id");
		$ventaU =$VentaModel->GetVentaU($id);
		$data=[
				"deleted_at"=>2,
			];		 
		$VentaModel->update($id, $data);
		
		$detalleVentaU =$VentaModel->getdetalleVenta($id);
		foreach ( $detalleVentaU as $row) {
			$idproductoVenta=$row->id_producto;
			$query=$ProductoModel->taer($idproductoVenta);
			$cantidadactual=$query->Stock;
			$cantidadventa=$row->cantidad;
			$cantidadactualizada=$cantidadactual+$cantidadventa;
			$dataproducto=[
				"Stock"=>$cantidadactualizada,
			];	
			$ProductoModel->update($idproductoVenta, $dataproducto);
		}

    }
   
  protected function generarnumero($numero){
  	if ($numero>= 99999 and $numero < 999999){
		return intval($numero)+1;
	}
	if ($numero>=9999 and $numero<99999){
		return "0" . strval(intval($numero)+1);
	}
	if ($numero>=999 and $numero<9999){
		return "00". strval(intval($numero)+1);
	}
	if ($numero>=99 and $numero<999){
		return "000". strval(intval($numero)+1);
	}
	if ($numero>=9 and $numero<99){
		return "0000". strval(intval($numero)+1);
	}
	if ($numero<9){
		return "00000" . strval(intval($numero)+1);
	}
  }
	
}
