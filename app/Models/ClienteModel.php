<?php namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model{ 
    protected $table      = 'clientes';
    protected $primaryKey = 'id_cliente';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_cliente','idtipo_cliente','dni_ruc','nombre','telefono','correo','direccion','sexo','deleted_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function getCliente(){
      $db=db_connect();
      $mostrar=$db->query("
                            SELECT *,clientes.deleted_at as estadocliente FROM clientes INNER JOIN tipo_cliente ON clientes.idtipo_cliente=tipo_cliente.idtipo_cliente
                              ");
      return $mostrar->getResult();
  	}
    function getTipo(){
      $db=db_connect();
      $mostrar=$db->query("
                            SELECT * from tipo_cliente where deleted_at is null
                              ");
      return $mostrar->getResult();
    }
    function getClienteU($id){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM clientes where id_cliente='.$id.'');
      return $mostrar->getRow();
    }
     public function compro_dni($dni){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM clientes where dni_ruc="'.$dni.'"');

      $row = $mostrar->getRow();
      if (isset($row)){ return false;}
      else{ return true;}
    }
    public function getclienteDni($dni){
       $db=db_connect();
      $mostrar= $db->query('SELECT * FROM clientes where dni_ruc="'.$dni.'"');

      $row = $mostrar->getRow();
      if (isset($row)){ return $mostrar->getRow();}
      else{ return false;}
    }
    public function compro_dni2($id,$dni){
     $db=db_connect();
       $query2= $db->query('SELECT dni_ruc from clientes where id_cliente="'.$id.'"');
       $row2 = $query2->getRow();
       if($row2->dni_ruc==$dni){
          $query= $db->query('select count(dni_ruc) as cantidad ,dni_ruc from clientes where  dni_ruc="'.$dni.'" group by dni_ruc having count(dni_ruc) > 1');
           return $row = $query->getRow();
       }else{
           $query= $db->query('select count(dni_ruc) as cantidad ,dni_ruc from clientes where  dni_ruc="'.$dni.'" group by dni_ruc having count(dni_ruc) > 0');
           return $row = $query->getRow();
       }
    }
     public function recogerid(){
      $db=db_connect();
      $id=$db->insertID();
      return $id;
    }
}