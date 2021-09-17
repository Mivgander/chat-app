<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUczestnicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uczestnicy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rozmowa_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('rozmowa_id')->references('id')->on('rozmowy')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uczestnicy');
    }
}
