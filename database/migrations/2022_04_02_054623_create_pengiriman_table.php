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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->string('pengiriman_id', 10);
            $table->primary('pengiriman_id');
            $table->string('slug');
            $table->string('permintaan_id', 10);
            $table->date('tanggal_pengiriman');

            $table->foreign('permintaan_id')
                ->references('permintaan_id')
                ->on('permintaan')->onDelete('cascade');

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
        Schema::dropIfExists('pengiriman');
    }
};
