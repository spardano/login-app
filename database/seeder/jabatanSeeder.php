<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KodeJabatan;

class jabatanSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();\

        KodeJabatan::create([
            'nama' => '-',
            'jabatan' => '-',
            'nip' => '-',
            'nik' => '-',
            'gol' => '-',
            'eselon' => '-',
            'kode_jabatan' => '000',
            'ttd' => '',
        ]);
        KodeJabatan::create([
            'nama' => 'joko',
            'jabatan' => 'Sekretaris',
            'nip' => '098765432100',
            'nik' => '123456789108',
            'gol' => 'IVA',
            'eselon' => 'IV',
            'kode_jabatan' => 'A04',
            'ttd' => '62b5263484d2d.png',
        ]);
        KodeJabatan::create([
            'nama' => 'Jeki Fernanda',
            'jabatan' => 'Sekretaris',
            'nip' => '098765432101',
            'nik' => '123456789109',
            'gol' => 'II',
            'eselon' => 'III',
            'kode_jabatan' => 'B03',
            'ttd' => '62bc202d796a8.png',
        ]);
    }
}