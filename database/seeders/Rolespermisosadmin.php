<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class Rolespermisosadmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar y crear roles del sistema si no existen
        $admin = Role::firstOrCreate(['name' => 'Administrador']);
        $labor = Role::firstOrCreate(['name' => 'Laboratorio']); 
        $user = Role::firstOrCreate(['name' => 'Usuario']);

        // Crear permisos con verificaciones
        Permission::firstOrCreate(['name' => 'menuAdmin'])->syncRoles([$admin]);
        Permission::firstOrCreate(['name' => 'menuEstadistica'])->syncRoles([$admin]);
        Permission::firstOrCreate(['name' => 'menuConfiguraciones'])->syncRoles([$admin]);
        
        // ✅ NUEVO PERMISO para Laboratorio
        Permission::firstOrCreate(['name' => 'documentoslab'])->syncRoles([$labor]);

        // Verificar si el usuario administrador ya existe
        $administrador = User::firstOrNew(['email' => 'admin@admin.com']);
        
        if (!$administrador->exists) {
            // Crear usuario solo si no existe
            $administrador->fill([
                'name' => 'admin',
                'password' => bcrypt('123456789'),
                'email_verified_at' => '2022-02-26 20:48:29'
            ])->save();

            // Asignar rol
            $administrador->assignRole('Administrador');

            // Crear laboratorio
            $administrador->laboratorio()->create([
                'rif' => 'V-123456789-0',
                'nombre' => 'admin'
            ]);

            // Crear teléfono
            $administrador->telefono()->create([
                'codigo_internacional' => '+58',
                'codigo_operador' => '412',
                'nrotelefono' => '0000000000',
                'whatsapp' => false
            ]);
            
            $this->command->info('Usuario administrador creado exitosamente.');
        } else {
            $this->command->info('El usuario administrador ya existe, se omite la creación.');
            
            // Asegurar que tenga el rol Administrador
            if (!$administrador->hasRole('Administrador')) {
                $administrador->assignRole('Administrador');
            }
        }
    }
}
