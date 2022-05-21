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
        Schema::create('klasifikasi', function (Blueprint $table) {
            $table->string('klasifikasi_id', 17);
            $table->primary('klasifikasi_id');
            $table->string('slug');
            $table->string('gudang_id', 10)->nullable();
            $table->string('counter_id', 10)->nullable();
            $table->date('tgl_mulai_klasifikasi');
            $table->date('tgl_akhir_klasifikasi');
            $table->integer('total_biaya_pertahun');

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
        Schema::dropIfExists('klasifikasi');
    }
};
