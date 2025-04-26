<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampsToCitas extends Migration
{
    public function up()
    {
        $this->forge->addColumn('citas', [
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'motivo' // o el último campo actual
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('citas', ['created_at', 'updated_at', 'deleted_at']);
    }
}
