<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            data_pendudukSeeder::class,
            jabatanSeeder::class,
            kel_desaSeeder::class,
            UsersTableSeeder::class,
            RolesTableSeeder::class
        ]);
    }
}