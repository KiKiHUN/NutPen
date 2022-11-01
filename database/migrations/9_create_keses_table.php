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
            $table->bigInteger('Diak_tanora_ID')->unsigned()->index();
            $table->integer('Kesett_perc');
            $table->datetime('Datum');
            $table->boolean('igazolva')->default(false);
            $table->foreign('Diak_tanora_ID')->references('ID')->on('diaks_tanoras')->onDelete('cascade')->onUpdate('cascade');
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
