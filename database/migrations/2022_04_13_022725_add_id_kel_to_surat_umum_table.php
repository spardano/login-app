<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdKelToSuratUmumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_umum', function (Blueprint $table) {
            $table->integer('id_kel', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_umum', function (Blueprint $table) {
            Schema::dropColumns('kode_kel_desa');
        });
    }
}