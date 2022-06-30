<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratNikahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_nikah', function (Blueprint $table) {
            $table->id();
            $table->string('nik_calon', 20);
            $table->string('nik_pasangan', 20);
            $table->string('nik_ortulaki', 20);
            $table->string('nik_ortupere', 20);
            $table->string('kode_surat', 20);
            $table->string('suku_calon', 255);
            $table->string('suku_pasangan', 255);
            $table->string('nama_mamak', 255);
            $table->string('tmplahir_mamak', 255);
            $table->date('tgllahir_mamak');
            $table->string('negeriasal_mamak', 255);
            $table->string('bangsa_mamak', 255);
            $table->string('kerja_mamak', 255);
            $table->string('alamat_mamak', 255);
            $table->string('kawin_ke', 10);
            $table->date('tgl_nikah');
            $table->time('jam_nikah');
            $table->string('tempat_nikah', 255);
            $table->string('mahar_nikah', 255);

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
        Schema::dropIfExists('surat_nikah');
    }
}