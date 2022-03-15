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
        Schema::create('counter', function (Blueprint $table) {
            $table->id();
            $table->string('counter_id', 10);
            $table->primary('counter_id');
            $table->string('slug');
            $table->string('user_id', 10);
            $table->text('alamat_counter');

            $table->foreign('user_id')
                ->references('users')
                ->on('user_id')->onDelete('cascade');

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
        Schema::dropIfExists('counter');
    }
};
