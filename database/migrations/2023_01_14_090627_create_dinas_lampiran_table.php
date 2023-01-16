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
        Schema::create('dinas_lampiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dinas_id');
            $table->string('lampiran');
            $table->timestamps();

            $table->foreign('dinas_id')->references('id')->on('dinas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dinas_lampiran');
    }
};
