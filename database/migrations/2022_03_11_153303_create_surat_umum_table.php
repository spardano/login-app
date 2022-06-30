<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_umum', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 20);
            $table->string('kode_surat', 20);
            $table->string('kode_jabatan', 20);
            $table->text('alasan');
            $table->text('tujuan');
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
        Schema::dropIfExists('surat_umum');
    }
}