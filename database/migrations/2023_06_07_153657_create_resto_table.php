<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resto', function (Blueprint $table) {
            $table->id();
            $table->string('nama_resto');
            $table->string('kategori_resto');
            $table->string('deskripsi_singkat');
            $table->string('jam_operasional');
            $table->string('kontak');
            $table->string('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
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
        Schema::dropIfExists('resto');
    }
};
