<?php namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model{ 
    protected $table      = 'producto';
    protected $primaryKey = 'Id';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['Id','CodigoBarras','Descripcion','IdCategoria','PrecioCompra','PrecioVenta','Stock','deleted_at'];

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
                            SELECT 
                            p.Id,
                            p.CodigoBarras,
                            p.Descripcion,
                            p.Stock,
                            p.PrecioVenta,
                            p.deleted_at,
                            c.Descripcion as NombreCat
                            FROM producto as p inner join categoria as c
                            Where p.IdCategoria=c.Id
                          ");
      return $mostrar->getResult();
  	}

    public function traer_codigo(){
      $db=db_connect();
      $mostrar= $db->query("SELECT * FROM producto order by Id desc LIMIT 1");

      return $mostrar->getRow();
    }

    public function compro_pro($cob,$des){
      $db=db_connect();
      $mostrar= $db->query('SELECT * FROM producto where CodigoBarras="'.$cob.'" or Descripcion="'.$des.'"');

      $row = $mostrar->getRow();
      if (isset($row)){ return false;}
      else{ return true;}
    }
    public function taer_c(){
      $db=db_connect();
      $mostrar= $db->query("SELECT * FROM categoria where deleted_at is Null");

      return $mostrar->getResult();
    }
    public function taer($id){
      $db=db_connect();
      $query= $db->query('SELECT * FROM producto where Id='.$id.'');
      return $query->getRow();
    }

    public function getProductoVenta($valor){
       $db=db_connect();
       $query= $db->query("SELECT p.Id as idProducto,p.PrecioCompra AS PrecioCompra,p.PrecioVenta as precioVenta,p.Stock as Stock,   CONCAT(p.CodigoBarras,' ',c.Descripcion,' ',p.Descripcion) AS label from producto as p inner join categoria as c on p.IdCategoria=c.Id where CONCAT(p.CodigoBarras,' ',c.Descripcion,' ',p.Descripcion) like '$valor%' ");
       return $query->getResult();
    }
}