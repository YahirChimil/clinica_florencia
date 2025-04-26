<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiasNoLaborablesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fecha' => [
                'type' => 'DATE',
                'null' => false,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('dias_no_laborables');
    }

    public function down()
    {
        $this->forge->dropTable('dias_no_laborables');

    }
}
