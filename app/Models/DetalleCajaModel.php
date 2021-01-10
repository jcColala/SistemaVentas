<?php namespace App\Models;

use CodeIgniter\Model;

class DetalleCajaModel extends Model{ 
    protected $table      = 'detalle_caja_comprobante';
    protected $primaryKey = 'iddetalle_ccomprobante';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['iddetalle_ccomprobante','idcaja','idcomprobante','serie','correlativo','igv'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function delete_detalle_caja(){
      $db=db_connect();
      $mostrar=$db->query("DELETE from detalle_caja_comprobante where idcaja=1");
      return $mostrar->getResult();
  	}
    function getDetalleCaja(){
      $db=db_connect();
      $mostrar=$db->query("SELECT * FROM detalle_caja_comprobante INNER JOIN comprobantes ON comprobantes.id_comprobante=detalle_caja_comprobante.idcomprobante where detalle_caja_comprobante.idcaja=1");
      return $mostrar->getResult();
    }
    function getcomprobante($id){
      $db=db_connect();
       $mostrar= $db->query('SELECT * FROM detalle_caja_comprobante where iddetalle_ccomprobante='.$id.'');
      return $mostrar->getRow();
    }
    function getcomprobante2($id){
      $db=db_connect();
       $mostrar= $db->query('SELECT * FROM detalle_caja_comprobante where idcomprobante='.$id.'');
      return $mostrar->getRow();
    }
}