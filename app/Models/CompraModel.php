<?php namespace App\Models;

use CodeIgniter\Model;

class CompraModel extends Model{ 
    protected $table      = 'compra';
    protected $primaryKey = 'Id';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['Id','IdProveedor','IdUsuario','Comprobante','SerieComprobante','NumComprobante','Fecha','Importe','deleted_at'];

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

    public function idcompra(){
      $db=db_connect();
      $mostrar=$db->query("SELECT * FROM compra order by Id desc LIMIT 1");
      return $mostrar->getRow();
    }
    public function insertar_detalle($idcompra,$idpro,$cant,$precioc,$subtotal){
      $db=db_connect();
      $mostrar=$db->query('INSERT INTO detalle_compra VALUES(null,'.$idcompra.','.$idpro.','.$cant.','.$precioc.','.$subtotal.',"'.date("Y-m-d").'","'.date("Y-m-d").'",null)');
      return true;
    }
    public function cambio_stock($id,$cant){
      $db=db_connect();
      $mostrar=$db->query('UPDATE producto SET  Stock=(Stock +'.$cant.') WHERE Id='.$id.'');
      return true;
    }

}