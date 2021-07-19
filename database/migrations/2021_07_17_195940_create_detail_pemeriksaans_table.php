<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detail_pemeriksaan', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedInteger('id_pemeriksaan');
            $table->unsignedTinyInteger('tipe_pemeriksaan');
            $table->string('hasil', 15);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('detail_pemeriksaans');
    }
}
