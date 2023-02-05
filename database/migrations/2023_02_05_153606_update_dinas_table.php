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
        Schema::table('dinas', function (Blueprint $table) {
            $table->date('mulai_dinas')->nullable()->after('perihal');
            $table->date('berakhir_dinas')->nullable()->after('mulai_dinas');
            $table->string('alasan_reject')->nullable()->after('is_approved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dinas', function (Blueprint $table) {
            $table->dropColumn('mulai_dinas');
            $table->dropColumn('berakhir_dinas');
            $table->dropColumn('alasan_reject');
        });
    }
};
