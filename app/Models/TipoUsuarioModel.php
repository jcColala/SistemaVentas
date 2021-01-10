<?php namespace App\Models;

use CodeIgniter\Model;

class TipoUsuarioModel extends Model{ 
    protected $table      = 'tipo_usuario';
    protected $primaryKey = 'Id';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['Id','Descripcion','deleted_at'];

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
                            FROM tipo_usuario
                          ");
      return $mostrar->getResult();
  	}
    public function compro_d($des){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM tipo_usuario where Descripcion="'.$des.'"');

      $row = $mostrar->getRow();
      if (isset($row)){ return false;}
      else{ return true;}
    }
    public function compro_d_update($des,$id){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM tipo_usuario where Descripcion="'.$des.'" and Id='.$id.'');

      if(count($mostrar->getResult()) ==1){ return true;}
      else{
        $mostrar= $db->query('SELECT * FROM tipo_usuario where Descripcion="'.$des.'"');
         if(count($mostrar->getResult()) >=1){ return false;}
          else{ return true;}
      }
    }
    public function taer($id){
      $db=db_connect();
      $query= $db->query('SELECT * FROM tipo_usuario where Id='.$id.'');
      return $query->getRow();
    }
}