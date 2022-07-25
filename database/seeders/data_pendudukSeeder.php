<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\data_penduduk;

class data_pendudukSeeder extends Seeder
{
    public function run()
    {
        data_penduduk::create([
            'nik' => '123456789101',
            'kk' => '123456789202',
            'tmp_lahir' => 'BUKITTINGGI',
            'tgl_lahir' => '1989-01-01',
            'jenkel' => 'Laki-laki',
            'goldar' => 'O',
            'agama' => 'islam',
            'stat_hbkel' => 'Anak Kandung Laki-laki',
            'status_kawin' => 'Belum',
            'pendidikan' => 'S1/D4',
            'pekerjaan' => 'pns',
            'nama_ibu' => 'mawar eva',
            'nama_ayah' => 'aslam',
            'alamat' => 'pr.Tanjung Residen 73',
            'rt' => '01',
            'rw' => '02',
            'kelurahan' => 21,
            'kecamatan' => 'mandiangin',
            'kotakab' => 'BUKITTINGGI',
            'propinsi' => 'Sumatera Barat',
            'status_pend' => 'Sudah Lulus',
            'nama' => 'alan sungkir',
        ]);

        data_penduduk::create([
            'nik' => '123456789102',
            'kk' => '123456789202',
            'tmp_lahir' => 'BUKITTINGGI',
            'tgl_lahir' => '1963-02-02',
            'jenkel' => 'Laki-laki',
            'goldar' => 'A',
            'agama' => 'islam',
            'stat_hbkel' => 'orang tua laki-laki',
            'status_kawin' => 'Sudah',
            'pendidikan' => 'SD',
            'pekerjaan' => 'pns',
            'nama_ibu' => 'sofia',
            'nama_ayah' => 'jidin',
            'alamat' => 'pr.Tanjung Residen 73',
            'rt' => '01',
            'rw' => '02',
            'kelurahan' => 21,
            'kecamatan' => 'mandiangin',
            'kotakab' => 'BUKITTINGGI',
            'propinsi' => 'Sumatera Barat',
            'status_pend' => 'Sudah Lulus',
            'nama' => 'aslam',
        ]);

        data_penduduk::create([
            'nik' => '123456789103',
            'kk' => '123456789202',
            'tmp_lahir' => 'BUKITTINGGI',
            'tgl_lahir' => '1968-03-03',
            'jenkel' => 'Perempuan',
            'goldar' => 'O',
            'agama' => 'islam',
            'stat_hbkel' => 'Orang tua perempuan',
            'status_kawin' => 'Sudah',
            'pendidikan' => 'SMA/Sederajat',
            'pekerjaan' => 'IBR',
            'nama_ibu' => 'jawiah',
            'nama_ayah' => 'nurdin',
            'alamat' => 'pr.Tanjung Residen 73',
            'rt' => '01',
            'rw' => '02',
            'kelurahan' => 21,
            'kecamatan' => 'mandiangin',
            'kotakab' => 'BUKITTINGGI',
            'propinsi' => 'Sumatera Barat',
            'status_pend' => 'Sudah Lulus',
            'nama' => 'mawar efa',
        ]);

        data_penduduk::create([
            'nik' => '123456789108',
            'kk' => '123456789204',
            'tmp_lahir' => 'BUKITTINGGI',
            'tgl_lahir' => '1968-03-03',
            'jenkel' => 'Laki-laki',
            'goldar' => 'B',
            'agama' => 'islam',
            'stat_hbkel' => 'Orang tua Laki-laki',
            'status_kawin' => 'Sudah',
            'pendidikan' => 'S1 Management',
            'pekerjaan' => 'PNS',
            'nama_ibu' => 'alm.susan',
            'nama_ayah' => 'alm.herman',
            'alamat' => 'jl.patanangan',
            'rt' => '02',
            'rw' => '02',
            'kelurahan' => 21,
            'kecamatan' => 'mandiangin',
            'kotakab' => 'BUKITTINGGI',
            'propinsi' => 'Sumatera Barat',
            'status_pend' => 'Sudah Lulus',
            'nama' => 'Joko Susanto',
        ]);

        data_penduduk::create([
            'nik' => '123456789109',
            'kk' => '123456789204',
            'tmp_lahir' => 'BUKITTINGGI',
            'tgl_lahir' => '1970-03-03',
            'jenkel' => 'Perempuan',
            'goldar' => 'AB',
            'agama' => 'islam',
            'stat_hbkel' => 'Orang tua perempuan',
            'status_kawin' => 'Sudah',
            'pendidikan' => 'S1 Akuntansi',
            'pekerjaan' => 'PNS',
            'nama_ibu' => 'Murni',
            'nama_ayah' => 'Santo',
            'alamat' => 'jl.kurai',
            'rt' => '01',
            'rw' => '03',
            'kelurahan' => 19,
            'kecamatan' => 'Mandiangin',
            'kotakab' => 'BUKITTINGGI',
            'propinsi' => 'Sumatera Barat',
            'status_pend' => 'Sudah Lulus',
            'nama' => 'Ismi Fatimah',
        ]);
    }
}