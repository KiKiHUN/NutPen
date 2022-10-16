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
        Schema::create('ertekeles', function (Blueprint $table) {
            $table->id('ID');
            $table->unsignedTinyInteger('jegy');
            $table->dateTime('datum');

            $table->string('Tanar_azonosito',6);
            $table->foreign('Tanar_azonosito')->references('azonosito')->on('tanars')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('Tantargy_ID')->unsigned()->index();
            $table->foreign('Tantargy_ID')->references('ID')->on('tantargies')->onDelete('cascade')->onUpdate('cascade');

            $table->string('Diak_azonosito',6);
            $table->foreign('Diak_azonosito')->references('azonosito')->on('diaks')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('ertekeles');
    }
};
