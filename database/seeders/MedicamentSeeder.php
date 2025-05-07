<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medicament;

class MedicamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicamentos = [
            [
                'descripcion' => 'Tiamina 100 mg Tab',
                'codigo' => '06127',
                'c_referencial' => 30,
                'frecuencia' => '1 TAB VO C/24 horas a las 10am',
                'cantidad_por_defecto' => 30,
            ],
            [
                'descripcion' => 'Piridoxina 50mg TAB',
                'codigo' => '05491',
                'c_referencial' => 30,
                'frecuencia' => '1 TAB VO C/24 horas a las 10am',
                'cantidad_por_defecto' => 30,
            ],
            [
                'descripcion' => 'Ácido fólico 500 mcg (0,5 mg) TAB',
                'codigo' => '00200',
                'c_referencial' => 30,
                'frecuencia' => '1 TAB VO C/24 horas a las 10am',
                'cantidad_por_defecto' => 30,
            ],
            [
                'descripcion' => 'Losartan potásico 50 mg TAB',
                'codigo' => '04523',
                'c_referencial' => 60,
                'frecuencia' => '1 TAB VO C/24 horas a las 10am',
                'cantidad_por_defecto' => 60,
            ],
            [
                'descripcion' => 'Amlodipino 10 mg TAB',
                'codigo' => '00671',
                'c_referencial' => 90,
                'frecuencia' => '1 TAB VO C/24 horas a las 10am',
                'cantidad_por_defecto' => 90,
            ],
            [
                'descripcion' => 'Epoetina alfa 2000 UI/MI INY 1ml',
                'codigo' => '03107',
                'c_referencial' => 14,
                'frecuencia' => 'POR SESION DE HD',
                'cantidad_por_defecto' => 13,
            ],
            [
                'descripcion' => 'Vitamina B12 Hidroxocobalamina',
                'codigo' => '03979',
                'c_referencial' => 12,
                'frecuencia' => 'POR SESION DE HD',
                'cantidad_por_defecto' => 8,
            ],
            [
                'descripcion' => 'Hierro (COMO SACARATO) 5ml',
                'codigo' => '19238',
                'c_referencial' => 12,
                'frecuencia' => 'CADA SEMANA',
                'cantidad_por_defecto' => 4,
            ],
            // Puedes añadir más medicamentos aquí si los tienes con sus cantidades por defecto
        ];

        foreach ($medicamentos as $medicamento) {
            Medicament::create($medicamento);
        }
    }
}
