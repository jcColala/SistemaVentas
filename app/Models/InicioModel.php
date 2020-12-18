<?php namespace App\Models;

use CodeIgniter\Model;

class InicioModel extends Model{

	public function menu(){ 
      $db=db_connect();
      $mostrar=$db->query('
                              SELECT    
                                  *
                              FROM  categoria
                              where  Estado=1 ORDER BY Id asc
                              ') ;

        if(count($mostrar->getResult()) >0){ return $mostrar->getResult();}
        else{ return false;} 
      
  }
  public function producto(){ 
      $db=db_connect();
      $mostrar=$db->query('
                              SELECT    
                                  i_p.Id_Producto, p.Id,
                                  p.Nombre_G,
                                  p.Nombre_P,
                                  p.Precio,
                                  p.Descuento,
                                  i_p.Nombre_I
                              FROM  producto as p
                              inner join imagen_p as i_p
                              where  p.Id=i_p.Id_Producto and i_p.Mostrar=1 and p.Estado=1
                              ORDER BY p.Fecha_Registro desc
                              ') ;

        if(count($mostrar->getResult()) >0){ return $mostrar->getResult();}
        else{ return false;} 
      
  }

}