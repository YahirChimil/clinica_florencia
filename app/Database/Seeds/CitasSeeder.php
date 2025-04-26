<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CitasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre_paciente' => 'Juan Pérez',
                'fecha' => '2025-04-20',
                'hora' => '10:00:00',
                'motivo' => 'Chequeo general',
            ],
            [
                'nombre_paciente' => 'María López',
                'fecha' => '2025-04-21',
                'hora' => '11:30:00',
                'motivo' => 'Dolor de cabeza',
            ],
            [
                'nombre_paciente' => 'Carlos Martínez',
                'fecha' => '2025-04-22',
                'hora' => '09:45:00',
                'motivo' => 'Consulta de seguimiento',
            ]
        ];

        // Insertar los datos en la tabla 'citas'
        $this->db->table('citas')->insertBatch($data);
    }
}
