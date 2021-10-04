<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanPcrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_pcr', function (Blueprint $table) {
            $table->increments('id_pemeriksaan');
            $table->string('no_reg', 50);
            $table->string('pengirim', 50);
            $table->unsignedInteger('id_pasien');
            $table->unsignedTinyInteger('id_dokter');
            $table->text('keterangan');
            $table->date('tgl_swab');
            $table->date('tgl_diterima');
            $table->date('tgl_validasi');
            $table->date('tgl_cetak_hasil');
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
        Schema::dropIfExists('pemeriksaan_pcr');
    }
}
