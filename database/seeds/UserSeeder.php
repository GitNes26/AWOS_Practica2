<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123465')
        ]);

        DB::table('users')->insert([
            'name' => 'Nestor',
            'email' => 'ness@gmail.com',
            'password' => bcrypt('123456')
        ]);

        factory(App\Models\User::class,5)->create();
    }
}
