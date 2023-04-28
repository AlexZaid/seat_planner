<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLyAssignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ly_assignations', function (Blueprint $table) {
            $table->id();
            $table->string('seatName');
            $table->integer('shift');
            $table->integer('id_emp');
            $table->boolean('confirmed');
            $table->string('keys');
            $table->timestamps();
            $table->foreign('id_emp')->references('id_emp')->on('employee');
            $table->foreign('shift')->references('shift')->on('shift');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ly_assignations');
    }
}
