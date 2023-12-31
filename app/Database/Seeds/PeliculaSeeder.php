<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\PeliculaModel;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        
        $peliculaModel->where("id <> 0")->truncate();

        $categorias = $categoriaModel->limit(7)->findAll();

        foreach ($categorias as $categoria) {
            
            for ($i=0; $i <10 ; $i++) { 
            
                $peliculaModel->insert([
                    "titulo" => "Pelicula $i",
                    "descripcion" => "Descripción pelicula $i",
                    "categoria_id" => $categoria->id
                ]);
    
            }

        }


      
    }
}
