<?php namespace App\Models;

use CodeIgniter\Model;

class PedidosModel extends Model{ 
    protected $table      = 'pedidos';
    protected $primaryKey = 'id_pedido';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_pedido','id_usuario','id_comprobante','correlativo','serie','subtotal','igv','descuento','totalventa','deleted_at','id_cliente'];

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
   
   public function  getpedido(){
      $db=db_connect();
      $mostrar=$db->query('SELECT *,pedidos.deleted_at as estadopedido  FROM pedidos INNER JOIN clientes ON clientes.id_cliente=pedidos.id_cliente INNER JOIN usuario on usuario.Id=pedidos.id_usuario INNER JOIN comprobantes ON comprobantes.id_comprobante=pedidos.id_comprobante ');
      return $mostrar->getResult();
   } 
   public function getPedidoU($id){
      $db=db_connect();
      $mostrar=$db->query('SELECT *,pedidos.created_at as fechapedido,date(pedidos.updated_at) as fechafacturacion,time(pedidos.updated_at) as horafacturacion ,pedidos.deleted_at as estadoventa  FROM pedidos INNER JOIN clientes ON clientes.id_cliente=pedidos.id_cliente INNER JOIN usuario on usuario.Id=pedidos.id_usuario INNER JOIN comprobantes ON comprobantes.id_comprobante=pedidos.id_comprobante where id_pedido='.$id.' ');
      return $mostrar->getRow();
   }
   public function getdetallePedido($id){
     $db=db_connect();
      $mostrar=$db->query('SELECT * FROM detalle_pedido_producto INNER JOIN producto on producto.Id=detalle_pedido_producto.id_producto where id_pedido='.$id.' ');
      return $mostrar->getResult();
   }
}