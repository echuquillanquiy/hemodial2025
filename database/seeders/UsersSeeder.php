<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario SuperAdministrador
        $superAdmin = User::create([
            'nombres_apellidos' => 'Eduardo Chuquillanqui',
            'dni' => '46589634',
            'email' => 'echuquillanquiy@gmail.com',
            'username' => 'echuquillanqui',
            'password' => bcrypt('password'), // Cambia 'password' por una contraseña segura
            'rol' => 'Administrador del Sistema',
            'email_verified_at' => now(),
        ]);
        //$superAdminRole = Role::findByName('SuperAdministrador');
        //$superAdmin->assignRole($superAdminRole);

        // Crear usuario Medico
        $medico = User::create([
            'nombres_apellidos' => 'Medico Ejemplo',
            'dni' => '87654321',
            'email' => 'medico@example.com',
            'username' => 'medico',
            'rol' => 'Medico',
            'modulo' => 'TODOS',
            'password' => bcrypt('password'), // Cambia 'password' por una contraseña segura
            'email_verified_at' => now(),
        ]);
        //$medicoRole = Role::findByName('Medico');
        //$medico->assignRole($medicoRole);

        // Crear usuario Licenciado
        $licenciado = User::create([
            'nombres_apellidos' => 'Licenciado Ejemplo',
            'dni' => '11223344',
            'email' => 'licenciado@example.com',
            'username' => 'licenciado',
            'rol' => 'Licenciado',
            'modulo' => 'MODULO 1',
            'colegiatura' => '923456',
            'password' => bcrypt('password'), // Cambia 'password' por una contraseña segura
            'email_verified_at' => now(),
        ]);
        //$licenciadoRole = Role::findByName('Licenciado');
        //$licenciado->assignRole($licenciadoRole);

        // Crear usuario Tecnico
        $tecnico = User::create([
            'nombres_apellidos' => 'Tecnico Ejemplo',
            'dni' => '55667788',
            'email' => 'tecnico@example.com',
            'username' => 'tecnico',
            'rol' => 'Tecnico',
            'password' => bcrypt('password'), // Cambia 'password' por una contraseña segura
            'email_verified_at' => now(),
        ]);
        //$tecnicoRole = Role::findByName('tecnico');
        //$tecnico->assignRole($tecnicoRole);

        // Crear usuario Auditor
        $auditor = User::create([
            'nombres_apellidos' => 'Auditor Ejemplo',
            'dni' => '99887766',
            'email' => 'auditor@example.com',
            'username' => 'auditor',
            'rol' => 'Auditor',
            'password' => bcrypt('password'), // Cambia 'password' por una contraseña segura
            'email_verified_at' => now(),
        ]);
        //$auditorRole = Role::findByName('auditor');
        //$auditor->assignRole($auditorRole);
    }
}
