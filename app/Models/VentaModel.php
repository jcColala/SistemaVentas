<?php namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model{ 
    protected $table      = 'ventas';
    protected $primaryKey = 'id_venta';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_cliente','id_usuario','id_comprobante','correlativo','serie','subtotal','igv','descuento','totalventa','deleted_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function recogerid(){
      $db=db_connect();
      $id=$db->insertID();
      return $id;
    }
   //  function mostrar(){
   //    $db=db_connect();
   //    $mostrar=$db->query("
   //                          SELECT * 
   //                          FROM usuario
   //                            ");
   //    return $mostrar->getResult();
  	// }
   //  function mostrar_tipo(){
   //    $db=db_connect();
   //    $mostrar=$db->query("
   //                          SELECT * 
   //                          FROM tipo_usuario 
   //                          WHERE deleted_at is Null
   //                            ");
   //    return $mostrar->getResult();
   //  }
   //  public function compro_dni($dni){
   //    $db=db_connect();
   //    $mostrar= $db->query('SELECT * FROM usuario where DNI="'.$dni.'"');

   //    $row = $mostrar->getRow();
   //    if (isset($row)){ return false;}
   //    else{ return true;}
   //  }
   //  public function compro_u($login){
   //    $db=db_connect();
   //    $mostrar= $db->query('SELECT * FROM usuario where Login="'.$login.'"');

   //    $row = $mostrar->getRow();
   //    if (isset($row)){ return false;}
   //    else{ return true;}
   //  }
   //  public function taer($id){
   //    $db=db_connect();
   //    $mostrar= $db->query('SELECT * FROM usuario where Id='.$id.'');
   //    return $mostrar->getRow();
   //  }
   public function  GetVenta(){
      $db=db_connect();
      $mostrar=$db->query('SELECT *,ventas.deleted_at as estadoventa  FROM ventas INNER JOIN clientes ON clientes.id_cliente=ventas.id_cliente INNER JOIN usuario on usuario.Id=ventas.id_usuario INNER JOIN comprobantes ON comprobantes.id_comprobante=ventas.id_comprobante ');
      return $mostrar->getResult();
   } 
   public function GetVentaU($id){
      $db=db_connect();
      $mostrar=$db->query('SELECT *,ventas.created_at as fechaventa,ventas.deleted_at as estadoventa  FROM ventas INNER JOIN clientes ON clientes.id_cliente=ventas.id_cliente INNER JOIN usuario on usuario.Id=ventas.id_usuario INNER JOIN comprobantes ON comprobantes.id_comprobante=ventas.id_comprobante where id_venta='.$id.' ');
      return $mostrar->getRow();
   }
   public function getdetalleVenta($id){
     $db=db_connect();
      $mostrar=$db->query('SELECT * FROM detalle_venta_producto INNER JOIN producto on producto.Id=detalle_venta_producto.id_producto where id_venta='.$id.' ');
      return $mostrar->getResult();
   }
}