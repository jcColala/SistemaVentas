<?php namespace App\Models;

use CodeIgniter\Model;

class CajaModel extends Model{ 
    protected $table      = 'cajas';
    protected $primaryKey = 'id_caja';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_caja','descripcion','id_usuario','monto','deleted_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function getCaja(){
      $db=db_connect();
      $mostrar=$db->query("
                            SELECT *,cajas.deleted_at as estadocaja FROM cajas INNER JOIN usuario ON usuario.Id=cajas.id_usuario
                              ");
      return $mostrar->getResult();
  	}
    function getCajeros(){
      $db=db_connect();
      $mostrar=$db->query("
                           SELECT *,usuario.Id as Idusuario FROM usuario INNER JOIN tipo_usuario ON usuario.Id_Tipo=tipo_usuario.Id where tipo_usuario.Id=2
                              ");
      return $mostrar->getResult();
    }
    public function taer($id){
      $db=db_connect();
      $query= $db->query('SELECT * FROM usuario where Id='.$id.'');
      return $query->getRow();
    }
}