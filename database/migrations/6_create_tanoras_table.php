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
        Schema::create('tanoras', function (Blueprint $table) {
            $table->id('ID');
            $table->bigInteger('Tantargy_ID')->unsigned()->index();
            $table->dateTime('kezdet');
            $table->dateTime('veg');
            $table->string('Tanar_azonosito',6);
            $table->foreign('Tantargy_ID')->references('ID')->on('tantargies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Tanar_azonosito')->references('azonosito')->on('tanars')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('Diak_tanoras', function (Blueprint $table) {
            $table->id('ID');
            $table->bigInteger('Tanora_ID')->unsigned()->index();
            $table->string('Diak_azonosito',6);
            $table->foreign('Tanora_ID')->references('ID')->on('tanoras')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('keses');
        Schema::dropIfExists('Diak_tanoras');
        Schema::dropIfExists('tanoras');
    }
};
