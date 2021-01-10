<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{ 
    protected $table      = 'usuario';
    protected $primaryKey = 'Id';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['Id','Id_Tipo','Nombre','Apellidos','DNI','Celular','Correo','Direccion','Sexo','Estado_Civil','Fecha_Nacimiento','Fecha_Ingreso','Login','Clave','Nombre_Foto','deleted_at'];

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
                            FROM usuario
                              ");
      return $mostrar->getResult();
  	}
    function mostrar_tipo(){
      $db=db_connect();
      $mostrar=$db->query("
                            SELECT * 
                            FROM tipo_usuario 
                            WHERE deleted_at is Null
                              ");
      return $mostrar->getResult();
    }
    public function compro_dni($dni){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM usuario where DNI="'.$dni.'"');

      $row = $mostrar->getRow();
      if (isset($row)){ return false;}
      else{ return true;}
    }
    public function compro_dni_update($dni,$id){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM usuario where DNI="'.$dni.'" and Id='.$id.'');

      if(count($mostrar->getResult()) ==1){ return true;}
      else{
          $mostrar= $db->query('SELECT * FROM usuario where DNI="'.$dni.'"');
          if(count($mostrar->getResult()) >=1){ return false;}
          else{ return true;}
      }
    }
    public function compro_u($login){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM usuario where Login="'.$login.'"');

      $row = $mostrar->getRow();
      if (isset($row)){ return false;}
      else{ return true;}
    }
    public function taer($id){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM usuario where Id='.$id.'');
      return $mostrar->getRow();
    }
}