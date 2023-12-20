<?php

namespace App\Models;

use CodeIgniter\Model;

class EtiquetaModel extends Model
{
    protected $table            = 'etiquetas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["titulo","categoria_id"];

}
