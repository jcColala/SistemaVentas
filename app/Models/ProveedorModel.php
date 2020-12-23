<?php namespace App\Models;

use CodeIgniter\Model;

class ProveedorModel extends Model{ 
    protected $table      = 'proveedor';
    protected $primaryKey = 'Id';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['Id','Nombre','DNI_RUC','Celular','Telefono','Correo','Direccion','deleted_at'];

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
                            FROM proveedor
                              ");
      return $mostrar->getResult();
  	}
    public function compro_dni($dni_ruc){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM proveedor where DNI_RUC="'.$dni_ruc.'"');

      $row = $mostrar->getRow();
      if (isset($row)){ return false;}
      else{ return true;}
    }
    public function taer($id){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM proveedor where Id='.$id.'');
      return $mostrar->getRow();
    }
}