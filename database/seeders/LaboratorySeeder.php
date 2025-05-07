<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laboratory;

class LaboratorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $examenes = [
            [
                'descripcion' => 'Nitrógeno ureico; cuantitativo (Urea sérica)',
                'codigo' => '84520',
                'cantidad' => 2,
                'tipo_examen' => 'MENSUAL',
            ],
            [
                'descripcion' => 'Hematocrito',
                'codigo' => '85014',
                'cantidad' => 1,
                'tipo_examen' => 'MENSUAL',
            ],
            [
                'descripcion' => 'Hemoglobina',
                'codigo' => '85018',
                'cantidad' => 1,
                'tipo_examen' => 'MENSUAL',
            ],
            [
                'descripcion' => 'Perfil de electrolitos (Cloro, Sodio y Potasio).',
                'codigo' => '80051',
                'cantidad' => 1,
                'tipo_examen' => 'MENSUAL',
            ],
            [
                'descripcion' => 'Dosaje de Fósforo inorgánico (fosfato)',
                'codigo' => '84100',
                'cantidad' => 1,
                'tipo_examen' => 'MENSUAL',
            ],
            [
                'descripcion' => 'Dosaje de Calcio; total',
                'codigo' => '82310',
                'cantidad' => 1,
                'tipo_examen' => 'MENSUAL',
            ],
            [
                'descripcion' => 'Aspartato amino transferasa (AST) (SGOT)',
                'codigo' => 84450,
                'cantidad' => 1,
                'tipo_examen' => 'BIMENSUAL',
            ],
            [
                'descripcion' => 'Alanina amino transferasa (ALT) (SGPT)',
                'codigo' => 84460,
                'cantidad' => 1,
                'tipo_examen' => 'BIMENSUAL',
            ],
            [
                'descripcion' => 'Dosaje de Albumina, suero, plasma o sangre total',
                'codigo' => '82040',
                'cantidad' => 1,
                'tipo_examen' => 'TRIMESTRAL',
            ],
            [
                'descripcion' => 'Dosaje de fosfata alcalina',
                'codigo' => '84075',
                'cantidad' => 1,
                'tipo_examen' => 'TRIMESTRAL',
            ],
            [
                'descripcion' => 'Dosaje de Hierro',
                'codigo' => '83540',
                'cantidad' => 1,
                'tipo_examen' => 'TRIMESTRAL',
            ],
            [
                'descripcion' => 'Dosaje de Ferritina',
                'codigo' => '82728',
                'cantidad' => 1,
                'tipo_examen' => 'TRIMESTRAL',
            ],
            [
                'descripcion' => 'Dosaje de Transferrina',
                'codigo' => '84466',
                'cantidad' => 1,
                'tipo_examen' => 'TRIMESTRAL',
            ],
            [
                'descripcion' => 'Dosaje de Paratohormona (hormona paratiroidea)',
                'codigo' => '83970',
                'cantidad' => 1,
                'tipo_examen' => 'TRIMESTRAL',
            ],
            [
                'descripcion' => 'Anticuerpos; HIV-1 y HIV-2, análisis unico',
                'codigo' => '86703',
                'cantidad' => 1,
                'tipo_examen' => 'SEMESTRAL',
            ],
            [
                'descripcion' => 'Prueba de sífilis; anticuerpo no treponemico; cualitativo',
                'codigo' => '86592',
                'cantidad' => 1,
                'tipo_examen' => 'SEMESTRAL',
            ],
            [
                'descripcion' => 'Deteccion de antigenos de hepatitis B antigeno de superficie (HBsAg)',
                'codigo' => '87340',
                'cantidad' => 1,
                'tipo_examen' => 'SEMESTRAL',
            ],
            [
                'descripcion' => 'Anticuerpo contra el antigeno de superficie de la hepatitis B (HBsAb)',
                'codigo' => '86706',
                'cantidad' => 1,
                'tipo_examen' => 'SEMESTRAL',
            ],
            [
                'descripcion' => 'Antcuerpo contra el antigeno de la nucleocapside de la hepatitis B (HBcAb)',
                'codigo' => '86704',
                'cantidad' => 1,
                'tipo_examen' => 'SEMESTRAL',
            ],
            [
                'descripcion' => 'Anticuerpo contra la hepatitis C',
                'codigo' => '86803',
                'cantidad' => 1,
                'tipo_examen' => 'SEMESTRAL',
            ],
            [
                'descripcion' => 'Anticuerpo para HTLV 1',
                'codigo' => '86687',
                'cantidad' => 0,
                'tipo_examen' => 'SEMESTRAL',
            ],
            // Si tienes más exámenes, añádelos aquí con su respectivo tipo_examen
        ];

        foreach ($examenes as $examen) {
            Laboratory::create($examen);
        }
    }
}
