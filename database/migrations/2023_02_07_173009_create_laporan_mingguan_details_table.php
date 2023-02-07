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
        Schema::create('laporan_mingguan_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('laporan_mingguan_id')->unsigned();
            $table->foreign('laporan_mingguan_id')->references('id')->on('laporan_mingguans')->onDelete('cascade');
            $table->string('kd_jenis_pekerjaan');
            $table->string('nmp');
            $table->string('volume');
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
        Schema::dropIfExists('laporan_mingguan_details');
    }
};
