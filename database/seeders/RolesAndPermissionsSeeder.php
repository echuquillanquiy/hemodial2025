<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reiniciar la caché de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos base para Usuarios
        $verUsuarios = Permission::create(['name' => 'ver usuarios']);
        $crearUsuarios = Permission::create(['name' => 'crear usuarios']);
        $editarUsuarios = Permission::create(['name' => 'editar usuarios']);
        $eliminarUsuarios = Permission::create(['name' => 'eliminar usuarios']);

        // Crear permisos base para Roles
        $verRoles = Permission::create(['name' => 'ver roles']);
        $crearRoles = Permission::create(['name' => 'crear roles']);
        $editarRoles = Permission::create(['name' => 'editar roles']);
        $eliminarRoles = Permission::create(['name' => 'eliminar roles']);

        // Crear permisos base para (ejemplo) Pacientes
        $verPacientes = Permission::create(['name' => 'ver pacientes']);
        $crearPacientes = Permission::create(['name' => 'crear pacientes']);
        $editarPacientes = Permission::create(['name' => 'editar pacientes']);
        $eliminarPacientes = Permission::create(['name' => 'eliminar pacientes']);

        // Crear roles y asignar permisos
        $superAdminRole = Role::findByName('SuperAdministrador');
        // El SuperAdministrador tendrá todos los permisos
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::findByName('Administrador');
        // El Administrador podrá gestionar usuarios y roles, y ver pacientes
        $adminRole->givePermissionTo([
            $verUsuarios, $crearUsuarios, $editarUsuarios, $eliminarUsuarios,
            $verRoles, $crearRoles, $editarRoles, $eliminarRoles,
            $verPacientes, $crearPacientes, $editarPacientes, $eliminarPacientes,
        ]);

        $medicoRole = Role::findByName('Medico');
        // El Médico podrá ver y crear pacientes (ejemplo)
        $medicoRole->givePermissionTo([$verPacientes, $crearPacientes, $editarPacientes]);

        $licenciadoRole = Role::findByName('Licenciado');
        // El Licenciado podrá ver pacientes (ejemplo)
        $licenciadoRole->givePermissionTo([$verPacientes, $editarPacientes]);

        $tecnicoRole = Role::findByName('tecnico');
        // El Técnico podrá ver pacientes (ejemplo)
        $tecnicoRole->givePermissionTo([$verPacientes]);

        $auditorRole = Role::findByName('auditor');
        // El Auditor podrá ver pacientes (ejemplo)
        $auditorRole->givePermissionTo([$verPacientes]);
    }
}
