<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLyKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ly_keys', function (Blueprint $table) {
            $table->id();
            $table->string('seatName');
            $table->integer('shift');
            $table->string('seatKeys');
            $table->timestamps();
            $table->foreign('seatName')->references('seatName')->on('ly_seats');
            $table->foreign('shift')->references('shift')->on('ly_shifts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ly_keys');
    }
}
