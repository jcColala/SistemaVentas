<?php namespace App\Models;

use CodeIgniter\Model;

class DetalleCajaModel extends Model{ 
    protected $table      = 'detalle_caja_comprobante';
    protected $primaryKey = 'iddetalle_comprobante';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['iddetalle_comprobante','idcaja','idcomprobante','serie','correlativo'];

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
      $mostrar=$db->query("SELECT * FROM detalle_caja_comprobante INNER JOIN combrobantes ON combrobantes.id_comprobante=detalle_caja_comprobante.idcomprobante where detalle_caja_comprobante.idcaja=1");
      return $mostrar->getResult();
    }
}