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
        Schema::create('logins', function (Blueprint $table) {
            $table->id();
            $table->string('azonositok',6);
            $table->string('jelszo',20);
            $table->bigInteger('felh_tipuses_ID')->unsigned()->index()->nullable();
            $table->foreign('felh_tipuses_ID')->references('ID')->on('felh_tipuses')->onDelete('cascade')->onUpdate('cascade');
            
            
            
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
        Schema::dropIfExists('logins');
    }
};
