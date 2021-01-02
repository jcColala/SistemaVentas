<?php namespace App\Models;

use CodeIgniter\Model;

class DetalleVentaModel extends Model{ 
    protected $table      = 'detalle_venta_producto';
    protected $primaryKey = 'iddetalle_vproducto';

    protected $returnType     = 'objet';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_venta','id_producto','cantidad','importe','precio_venta'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}