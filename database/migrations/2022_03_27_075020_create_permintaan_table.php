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
        Schema::create('permintaan', function (Blueprint $table) {
            $table->string('permintaan_id', 10);
            $table->primary('permintaan_id');
            $table->string('slug');
            $table->string('counter_id', 10);
            $table->date('tanggal_permintaan');
            $table->string('status');

            $table->foreign('counter_id')
                ->references('counter_id')
                ->on('counter')->onDelete('cascade');

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
        Schema::dropIfExists('permintaan');
    }
};
