<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaEtiquetaModel extends Model
{
    protected $table            = 'pelicula_etiqueta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["pelicula_id","etiqueta_id"];

}
