<?php namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model{ 

    function verificar($usuario,$pasword){
      $db=db_connect();
      $mostrar=$db->query("
                            SELECT * 
                            FROM usuario 
                            WHERE Login='".$usuario."' and Clave='".$pasword."'
                              ");
      $row = $mostrar->getRow();
      if (isset($row)){ return $row;}
      else{ return false;}

  	}
}