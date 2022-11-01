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
        Schema::create('szulos', function (Blueprint $table) {
            $table->string('azonosito',6)->primary();
            $table->string('jelszo',60);
            $table->string('vnev',50);
            $table->string('knev',50);
            $table->bigInteger('felh_tipus_ID')->unsigned()->index();
            $table->foreign('felh_tipus_ID')->references('ID')->on('felh_tipuses')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('szulos');
        
    }
};
