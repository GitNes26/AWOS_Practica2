<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('roles')->insert([
        //     'role' => 'Lector',
        //     'description' => 'Este usuario solo puede ver los registros.'
        // ]);

        DB::table('roles')->insert([
            'role' => 'Capturador',
            'description' => 'Este usuario puede ver y agregar registros.'
        ]);

        DB::table('roles')->insert([
            'role' => 'Editor',
            'description' => 'Este usuario puede ver y modificar los registros.'
        ]);
        
        DB::table('roles')->insert([
            'role' => 'Administrador',
            'description' => 'Este usuario puede ver, agregar, modificar y eliminar los registros.'
        ]);
    }
}
