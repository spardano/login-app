<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenomoranSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penomoran_surat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kel_desa');
            $table->integer('id_jenis_surat');
            $table->string('no_surat');
            $table->string('mulai_dari');
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
        Schema::dropIfExists('penomoran_surat');
    }
}