<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->increments('id_pasien');
            $table->string('nik', 18)->unique()->nullable(false);
            $table->string('nama_pasien', 50)->nullable(false);
            $table->tinyInteger('umur')->nullable(false);
            $table->text('alamat')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('pasien');
    }
}
