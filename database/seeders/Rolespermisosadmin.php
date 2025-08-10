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
        //Roles del Sistema
        $admin = Role::create(['name' => 'Administrador']); //Administrador del Sistema
        $labor = Role::create(['name' => 'Laboratorio']); //Laboratorio
        $user = Role::create(['name' => 'Usuario']); //Usuario Final


        //permisos
        Permission::create(['name' => 'menuAdmin'])->syncRoles([$admin]);
        Permission::create(['name' => 'menuEstadistica'])->syncRoles([$admin]);
        Permission::create(['name' => 'menuConfiguraciones'])->syncRoles([$admin]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789'),
            'email_verified_at' => '2022-02-26 20:48:29'
        ])->assignRole('Administrador');
    }
}
