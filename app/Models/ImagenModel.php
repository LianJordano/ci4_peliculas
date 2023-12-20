<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenModel extends Model
{
    protected $table            = 'imagenes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["imagen","extension","data"];


    // m:m inverso
    public function getPeliculasById($id)
    {
        return $this->select("p.*")
        ->join("pelicula_imagen as pi", "pi.imagen_id = imagenes.id")
        ->join("peliculas as p", "p.id = pi.pelicula_id")
        ->where("imagenes.id",$id)->findAll();
    }

   
}
