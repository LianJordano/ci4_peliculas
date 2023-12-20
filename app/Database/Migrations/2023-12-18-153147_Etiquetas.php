<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Etiquetas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'categoria_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
       
       
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey("categoria_id", "categorias","id","CASCADE","CASCADE");
        $this->forge->createTable('etiquetas');
    }

    public function down()
    {
        $this->forge->dropTable('etiquetas');
    }
}
