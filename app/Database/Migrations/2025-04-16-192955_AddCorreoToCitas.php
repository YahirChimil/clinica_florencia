<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCorreoToCitas extends Migration
{
    public function up()
    {
        $this->forge->addColumn('citas', [
            'correo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'motivo' // o el último campo actual
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('citas', 'correo');
    }
}
