<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationshipTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Schema::table('pemeriksaan', function (Blueprint $table) {
        //     $table->foreign('id_pasien')->references('id_pasien')->on('pasien');
        //     $table->foreign('id_dokter')->references('id_dokter')->on('dokter');
        // });
        // Schema::table('detail_pemeriksaan', function (Blueprint $table) {
        //     $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan');
        //     $table->foreign('tipe_pemeriksaan')->references('id_tipe')->on('tipe_test');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
    }
}
