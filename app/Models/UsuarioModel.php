<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{ 

    function mostrar(){
      $db=db_connect();
      $mostrar=$db->query("
                            SELECT * 
                            FROM usuario 
                            WHERE Estado=1
                              ");
      return $mostrar->getResult();
  	}
    function mostrar_tipo(){
      $db=db_connect();
      $mostrar=$db->query("
                            SELECT * 
                            FROM usuario 
                            WHERE Estado=1
                              ");
      return $mostrar->getResult();
    }
}