<?php namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model{ 
    protected $table      = 'categoria';
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
                            FROM categoria
                          ");
      return $mostrar->getResult();
  	}
    public function compro_d($des){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM categoria where Descripcion="'.$des.'"');

      $row = $mostrar->getRow();
      if (isset($row)){ return false;}
      else{ return true;}
    }
    public function compro_d2($des,$id){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM categoria where Descripcion="'.$des.'" and Id='.$id.'');

      if(count($mostrar->getResult()) ==1){ return true;}
      else{
        $mostrar= $db->query('SELECT * FROM categoria where Descripcion="'.$des.'"');
         if(count($mostrar->getResult()) >=1){ return false;}
          else{ return true;}
      }
    }
    public function taer($id){
      $db=db_connect();
      $query= $db->query('SELECT * FROM categoria where Id='.$id.'');
      return $query->getRow();
    }
}