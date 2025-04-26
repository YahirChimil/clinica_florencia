<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Citas extends Migration
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
            'nombre_paciente' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'fecha' => [
                'type' => 'DATE',
            ],
            'hora' => [
                'type' => 'TIME',
            ],
            'motivo' => [
                'type' => 'TINYTEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('citas');
    }

    public function down()
    {
        $this->forge->dropTable('citas');
    }
}
