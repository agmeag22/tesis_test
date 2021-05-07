<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuario')->insert([
            'nombre' => 'admin',
            'email' => 'admin',
            'username' => 'admin',
            'idrol' => 1,
            'password' => Hash::make('admin'),
        ]);
        DB::table('role')->insert([
            'nombre' => 'Administrador',
        ]);
        DB::table('role')->insert([
            'nombre' => 'Usuario',
        ]);
        // $this->call(UserSeeder::class);
    }
}
