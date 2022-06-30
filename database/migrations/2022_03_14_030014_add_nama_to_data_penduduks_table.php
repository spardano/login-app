<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaToDataPenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_penduduks', function (Blueprint $table) {
            $table->string('nama', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_penduduks', function (Blueprint $table) {
            Schema::dropColumns('nama');
        });
    }
}