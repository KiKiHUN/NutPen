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
       Schema::create('keses', function (Blueprint $table) {
            $table->id('ID');
            $table->bigInteger('Osszekoto_ID')->unsigned()->index();
            $table->integer('Kesett_perc');
            $table->foreign('Osszekoto_ID')->references('ID')->on('Diak_tanoras')->onDelete('cascade')->onUpdate('cascade'); 
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
    }
};
