<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWiadomosciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiadomosci', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rozmowa_id');
            $table->unsignedBigInteger('nadawca_id');
            $table->text('wiadomosc');
            $table->timestamps();

            $table->foreign('rozmowa_id')->references('id')->on('rozmowy')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nadawca_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wiadomosci');
    }
}
