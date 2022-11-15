<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pemilihan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemilihan', function (Blueprint $table) {
            $table->id();
            $table->integer('jml_pemilih');
            $table->foreignId('kandidat_id')->nullable()->constrained()->references('id')->on('kandidat')->onDelete('cascade');
            $table->foreignId('periode_id')->nullable()->constrained()->references('id')->on('periode')->onDelete('cascade');
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
        Schema::dropIfExists('pemilihan');
    }
}
