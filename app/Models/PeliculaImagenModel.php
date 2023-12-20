<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaImagenModel extends Model
{
    protected $table            = 'pelicula_imagen';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["pelicula_id","imagen_id"];

}
