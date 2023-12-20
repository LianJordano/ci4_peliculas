<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarCategoriaAPeliculas extends Migration
{
    public function up()
    {
        $this->forge->addColumn('peliculas', [
            'categoria_id INT(5) UNSIGNED',
        ]);

        $this->db->query('ALTER TABLE peliculas ADD CONSTRAINT fk_categoria_id FOREIGN KEY (categoria_id) REFERENCES categorias(id)');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE peliculas DROP FOREIGN KEY fk_categoria_id');
        $this->forge->dropColumn('peliculas', 'categoria_id');
    }
}
