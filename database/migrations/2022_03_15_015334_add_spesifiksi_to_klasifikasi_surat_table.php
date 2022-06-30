<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpesifiksiToKlasifikasiSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('klasifikasi_surat', function (Blueprint $table) {
            $table->string('spesifikasi_surat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('klasifikasi_surat', function (Blueprint $table) {
            Schema::dropColumns('spesifikasi_surat');
        });
    }
}