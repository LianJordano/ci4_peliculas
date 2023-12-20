<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $this->db->table("categorias");
        $categoriaModel = new CategoriaModel();

     /*    $this->db->table("categorias")->where("id <> 0")->truncate();
        for ($i = 0; $i < 20; $i++) {

            $this->db->table("categorias")->insert([
                "nombre" => "Categoria-" . $i
            ]);
        } */

        //$categoriaModel->where("id <> 0")->truncate();
        for ($i = 0; $i < 20; $i++) {

            $categoriaModel->insert([
                "nombre" => "Categoria $i",
            ]);
        }
    }
}
