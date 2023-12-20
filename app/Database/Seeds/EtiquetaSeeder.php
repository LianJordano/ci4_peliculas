<?php

namespace App\Database\Seeds;

use App\Models\EtiquetaModel;
use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class EtiquetaSeeder extends Seeder
{
    public function run()
    {
        $etiquetaModel = new EtiquetaModel();
        $categoriaModel = new CategoriaModel();
        
        
        $categorias = $categoriaModel->limit(7)->findAll();
        
        //$etiquetaModel->where("id <> 0")->truncate();

        foreach ($categorias as $categoria) {
            
            for ($i=0; $i <10 ; $i++) { 
            
                $etiquetaModel->insert([
                    "titulo" => "Tag $i $categoria->nombre",
                    "categoria_id" => $categoria->id
                ]);
    
            }

        }


      
    }
}
