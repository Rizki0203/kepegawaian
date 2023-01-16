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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('no_ktp')->nullable();
            $table->string('no_sim')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('no_passport')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->string('agama');
            $table->string('alamat');
            $table->string('tempat');
            $table->date('tanggal_lahir');
            $table->enum('status', ['menikah', 'belum_menikah']);
            $table->string('no_hp');
            $table->integer('tinggi')->nullable();
            $table->integer('berat')->nullable();
            $table->string('bank')->nullable();
            $table->string('no_rekening')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
