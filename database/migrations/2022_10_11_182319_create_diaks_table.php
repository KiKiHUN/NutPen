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
        Schema::create('diaks', function (Blueprint $table) {
            $table->string('azonosito',6)->primary();
            $table->string('jelszo',20);
            $table->string('vnev',50);
            $table->string('knev',50);
            $table->tinyInteger('elerhetoIgazolasok',false,true)->default(3);
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
        Schema::dropIfExists('diaks');
    }
};
