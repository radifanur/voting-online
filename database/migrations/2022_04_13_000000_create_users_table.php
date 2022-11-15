<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('nim')->nullable();
            $table->string('email')->nullable();
            $table->integer('roles_id')->nullable();
            $table->foreignId('periode_id')->nullable()->constrained()->references('id')->on('periode')->onDelete('cascade');
            $table->foreignId('kelas_id')->nullable()->constrained()->references('id')->on('kelas')->onDelete('cascade');
            $table->string('password');
            $table->string('status')->default('belum');
            $table->string('token')->unique()->nullable();
            $table->boolean('verif')->default(false)->comment('1 = Sudah | 0 = Belum');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
