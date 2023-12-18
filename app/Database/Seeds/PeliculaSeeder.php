<?php

namespace App\Database\Seeds;

use App\Models\PeliculaModel;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $peliculaModel = new PeliculaModel();

        $peliculaModel->where("id <> 0")->truncate();

        for ($i=0; $i <50 ; $i++) { 
            
            $peliculaModel->insert([
                "titulo" => "Pelicula $i",
                "descripcion" => "Descripción pelicula $i",
            ]);

        }
    }
}
