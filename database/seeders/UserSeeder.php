<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use jeremykenedy\LaravelRoles\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', '=', 'Admin')->first();

        $newUser = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'nik'      => '14080987837463',
            'password' => Hash::make('admin123'),
            'id_kel_desa' => 1
        ]);

        $newUser->attachRole($adminRole);
    }
}
