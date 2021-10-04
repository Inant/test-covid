<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTanggalAtPemeriksaanPcrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemeriksaan_pcr', function (Blueprint $table) {
            $table->dateTime('tgl_swab')->change();
            $table->dateTime('tgl_diterima')->change();
            $table->dateTime('tgl_validasi')->change();
            $table->dateTime('tgl_cetak_hasil')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemeriksaan_pcr', function (Blueprint $table) {
            $table->date('tgl_swab')->change();
            $table->date('tgl_diterima')->change();
            $table->date('tgl_validasi')->change();
            $table->date('tgl_cetak_hasil')->change();
        });
    }
}
