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
            $table->string('vnev',50);
            $table->string('knev',50);
            $table->timestamps();
        });

        Schema::create('diaks_szulos', function (Blueprint $table) {
            $table->string('Diak_azonosito',6);
            $table->string('Szulo_azonosito',6);
            $table->foreign('Szulo_azonosito')->references('azonosito')->on('szulos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Diak_azonosito')->references('azonosito')->on('diaks')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['Diak_azonosito', 'Szulo_azonosito']);
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
        Schema::dropIfExists('diaks_szulos');
        Schema::dropIfExists('szulos');
        
    }
};
