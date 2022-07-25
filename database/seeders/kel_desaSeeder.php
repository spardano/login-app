<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\kel_desa;

class kel_desaSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        kel_desa::create([
            'kode' => '1',
            'nama_kel_desa' => 'AUR KUNING',
            'kode_kel_desa' => 'AK'
        ]);
        kel_desa::create([
            'kode' => '2',
            'nama_kel_desa' => 'BELAKANG BALOK',
            'kode_kel_desa' => 'BB'
        ]);
        kel_desa::create([
            'kode' => '3',
            'nama_kel_desa' => 'BIRUGO',
            'kode_kel_desa' => 'BRG'
        ]);
        kel_desa::create([
            'kode' => '4',
            'nama_kel_desa' => 'KUBU TANJUNG',
            'kode_kel_desa' => 'KBT'
        ]);
        kel_desa::create([
            'kode' => '5',
            'nama_kel_desa' => 'LADANG CAKIAH',
            'kode_kel_desa' => 'LC'
        ]);
        kel_desa::create([
            'kode' => '6',
            'nama_kel_desa' => 'PAKAN LABUAH',
            'kode_kel_desa' => 'PL'
        ]);
        kel_desa::create([
            'kode' => '7',
            'nama_kel_desa' => 'PARIT ANTANG',
            'kode_kel_desa' => 'PA'
        ]);
        kel_desa::create([
            'kode' => '8',
            'nama_kel_desa' => 'SAPIRAN',
            'kode_kel_desa' => 'SPR'
        ]);
        kel_desa::create([
            'kode' => '9',
            'nama_kel_desa' => 'AUR TAJUNGKANG TANGAH SAWAH',
            'kode_kel_desa' => 'ATTS'
        ]);
        kel_desa::create([
            'kode' => '10',
            'nama_kel_desa' => 'BENTENG PASAR ATAS',
            'kode_kel_desa' => 'BPA'
        ]);
        kel_desa::create([
            'kode' => '11',
            'nama_kel_desa' => 'BUKIT APIT PUHUN',
            'kode_kel_desa' => 'BAP'
        ]);
        kel_desa::create([
            'kode' => '12',
            'nama_kel_desa' => 'BUKIT CANGANG KAYU RAMANG',
            'kode_kel_desa' => 'BCKR'
        ]);
        kel_desa::create([
            'kode' => '13',
            'nama_kel_desa' => 'KAYU KUBU',
            'kode_kel_desa' => 'KYKB'
        ]);
        kel_desa::create([
            'kode' => '14',
            'nama_kel_desa' => 'PAKAN KURAI',
            'kode_kel_desa' => 'PKR'
        ]);
        kel_desa::create([
            'kode' => '15',
            'nama_kel_desa' => 'TAROK DIPO',
            'kode_kel_desa' => 'TDP'
        ]);
        kel_desa::create([
            'kode' => '16',
            'nama_kel_desa' => 'CAMPAGO GUGUK BULEK',
            'kode_kel_desa' => 'CGB'
        ]);
        kel_desa::create([
            'kode' => '17',
            'nama_kel_desa' => 'CAMPAGO IPUH',
            'kode_kel_desa' => 'CMI'
        ]);
        kel_desa::create([
            'kode' => '18',
            'nama_kel_desa' => 'GAREGEH',
            'kode_kel_desa' => 'GRG'
        ]);

        kel_desa::create([
            'kode' => '19',
            'nama_kel_desa' => 'KOTO SELATAN',
            'kode_kel_desa' => 'KTS'
        ]);

        kel_desa::create([
            'kode' => '20',
            'nama_kel_desa' => 'KUBU GULAI BANCAH',
            'kode_kel_desa' => 'KGB'
        ]);

        kel_desa::create([
            'kode' => '21',
            'nama_kel_desa' => 'MANGGIS GANTING',
            'kode_kel_desa' => 'MG'
        ]);

        kel_desa::create([
            'kode' => '22',
            'nama_kel_desa' => 'PUHUN PINTU KABUN',
            'kode_kel_desa' => 'PPK'
        ]);

        kel_desa::create([
            'kode' => '23',
            'nama_kel_desa' => 'PUHUN TEMBOK',
            'kode_kel_desa' => 'PT'
        ]);
        kel_desa::create([
            'kode' => '24',
            'nama_kel_desa' => 'PULAI ANAK AIR',
            'kode_kel_desa' => 'PAA'
        ]);
        kel_desa::create([
            'kode' => '25',
            'nama_kel_desa' => 'KOTO SELAYAN',
            'kode_kel_desa' => 'KTSY'
        ]);
        kel_desa::create([
            'kode' => '0',
            'nama_kel_desa' => '-',
            'kode_kel_desa' => '-'
        ]);
    }
}