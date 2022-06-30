<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('kk');
            $table->string('tmp_lahir');
            $table->date('tgl_lahir');
            $table->string('jenkel');
            $table->string('goldar');
            $table->string('agama');
            $table->string('stat_hbkel');
            $table->string('status_kawin');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('nama_ibu');
            $table->string('nama_ayah');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kotakab');
            $table->string('propinsi');
            $table->string('status_pend');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_penduduks');
    }
}