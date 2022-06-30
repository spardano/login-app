<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlasifikasiSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klasifikasi_surat', function (Blueprint $table) {
            $table->id();
            $table->string('kode_surat', 10);
            $table->string('uraian', 255);
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
        Schema::dropIfExists('klasifikasi_surat');
    }
}