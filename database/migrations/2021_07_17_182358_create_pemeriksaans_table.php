<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->tinyIncrements('id_dokter');
            $table->string('nama_dokter', 50);
        });

        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->increments('id_pemeriksaan');
            $table->string('no_reg', 50);
            $table->unsignedInteger('id_pasien');
            $table->unsignedTinyInteger('id_dokter');
            $table->text('keterangan');
            $table->timestamp('tgl_pemeriksaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('dokter');
        Schema::dropIfExists('pemeriksaan');
    }
}
