<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPemeriksaanPcrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pemeriksaan_pcr', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedInteger('id_pemeriksaan');
            $table->unsignedTinyInteger('tipe_pcr');
            $table->string('hasil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pemeriksaan_pcr');
    }
}
