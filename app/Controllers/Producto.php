<?php namespace App\Controllers;
use App\Models\ProductoModel;
class Producto extends BaseController
{ 
	public function index(){
		$session = \Config\Services::session();
		if($session->get('login')==NULL){
			return redirect()->to(site_url("Login"));
		} 
		else{
			$producto=new ProductoModel;
			$data= array('producto' =>$producto->mostrar());

			echo view('main/header.php');
	        echo view('main/menu.php');
	        echo view('almacen/producto.php',$data);
	        echo view('main/footer.php'); 
    	}
	}
	public function agregarViews(){
		$producto=new ProductoModel;
		$request=\Config\Services::request();

		if (!base64_decode($request->getPostGet("id"))){
			$traer_codigo=$producto->traer_codigo();
			$codigo_barras=$traer_codigo->Id + 1;
			$codigo_barras=str_pad($codigo_barras,8,0, STR_PAD_LEFT); 
			$data=array(
				"id"=>'',
				"codigobrr"=>$codigo_barras,
				"descripcion"=>'',
				"idcategoria"=>'',
				"preciocompra"=>'',
				"precioventa"=>'',
				"stock"=>'',
				"categoria"=>$producto->taer_c()
			);
		}
		else{
			$id=base64_decode($request->getPostGet("id"));
			$traer=$producto->taer($id);
			$data=array(
				"id"=>$traer->Id,
				"codigobrr"=>$traer->CodigoBarras,
				"descripcion"=>$traer->Descripcion,
				"idcategoria"=>$traer->IdCategoria,
				"preciocompra"=>$traer->PrecioCompra,
				"precioventa"=>$traer->PrecioVenta,
				"stock"=>$traer->Stock,
				"categoria"=>$producto->taer_c()
			); 
		}

		echo view('main/header.php');
	    echo view('main/menu.php');
	    echo view('almacen/producto_add.php',$data);
	    echo view('main/footer.php'); 
	}
	public function agregar(){
		$producto=new ProductoModel;
		$request=\Config\Services::request();
		$id=$request->getPostGet("id");

		$data=[
				'CodigoBarras'=> $request->getPostGet("codigobrr"),
				'Descripcion'=> $request->getPostGet("descripcion"),
				'IdCategoria'=> $request->getPostGet("idcategoria"),
				'PrecioCompra'=> '',
				'PrecioVenta'=> $request->getPostGet("precioventa")
				
		];
		if ($request->getPostGet("codigobrr")=='' or $request->getPostGet("descripcion")=='' or $request->getPostGet("precioventa")=='' /*or $request->getPostGet("stock")==''*/ or $request->getPostGet("idcategoria")=='' ) {
				$alert="Es necesario ingresar el código de barras, descripción, precio venta y la categoría, son campos obligatorios";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
		}
		/*if ($request->getPostGet("precioventa")<=0 or $request->getPostGet("stock")<=0) {
			$alert="Precio venta y Stock no pueden ser menor o igual a cero";
			$this->session->setFlashdata('alert', $alert);
			return " <script type='text/javascript'>window.history.back();</script>";
		}*/
		if ($id=='') {
			if($producto->compro_pro($request->getPostGet("codigobrr"),$request->getPostGet("descripcion")) == false){
				$alert="¡ El Producto ya existe!";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}
			$producto->insert($data);
		}
		else{
			/*if($categoria->compro_d2($request->getPostGet("descripcion"),$request->getPostGet("id")) == false){
				$alert="¡ La descripción ya existe !";
				$this->session->setFlashdata('alert', $alert);
				return " <script type='text/javascript'>window.history.back();</script>";
			}*/ 
			$producto->update($id, $data);
		}
		return redirect()->to(site_url("Producto"));

	}
	public function activar_eliminar(){
		$request=\Config\Services::request();
		$producto=new ProductoModel;
		$id=$request->getPostGet('id');
		$op=$request->getPostGet('op');
		if ($op=='activar') {
			$data = [
			    'deleted_at' => NULL,
			];
			$producto->update($id, $data);
			echo json_encode('activo');
		}
		else{
			$producto->delete($id);
			echo json_encode('elimino');
		}
	}
	public function imprimir(){
		$request=\Config\Services::request();
		$producto=new ProductoModel;
		$codbrr=$request->getPostGet('c');
		$cant=$request->getPostGet('ct');

		$data=array(
				"codbrr"=>$codbrr,
				"cant"=>$cant
		);
	    echo view('almacen/imprimirCbrr.php',$data);
	}
}