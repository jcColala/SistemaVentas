<?php namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model{ 
    protected $table      = 'ventas';
    protected $primaryKey = 'id_venta';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_cliente','id_usuario','id_comprobante','correlativo','serie','igv','descuento'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

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
}