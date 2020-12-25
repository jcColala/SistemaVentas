<?php namespace App\Models;

use CodeIgniter\Model;

class CompraModel extends Model{ 
    protected $table      = 'compra';
    protected $primaryKey = 'Id';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['Id','IdProveedor','IdUsuario','TipoComprobante','SerieComprobante','Fecha','Importe','Total','deleted_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function mostrar(){
      $db=db_connect();
      $mostrar=$db->query("
                            SELECT * 
                            FROM compra
                          ");
      return $mostrar->getResult();
  	}
    public function comprobante(){
      $db=db_connect();
      $mostrar= $db->query("SELECT * FROM comprobantes WHERE deleted_at is Null");

     return $mostrar->getResult();
    }
    public function producto(){
      $db=db_connect();
      $mostrar= $db->query("SELECT * FROM producto WHERE deleted_at is Null");

     return $mostrar->getResult();
    }
    public function proveedor(){
      $db=db_connect();
      $mostrar= $db->query("SELECT * FROM proveedor WHERE deleted_at is Null");

     return $mostrar->getResult();
    }




    public function compro_d($des){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM marca where Descripcion="'.$des.'"');

      $row = $mostrar->getRow();
      if (isset($row)){ return false;}
      else{ return true;}
    }
    public function compro_d2($des,$id){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM marca where Descripcion="'.$des.'"');

      if(count($mostrar->getResult()) <=1){ return true;}
      else{ return false;}
    }
    public function taer($id){
      $db=db_connect();
      $query= $db->query('SELECT * FROM marca where Id='.$id.'');
      return $query->getRow();
    }
}