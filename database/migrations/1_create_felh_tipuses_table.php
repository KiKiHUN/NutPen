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
        Schema::create('felh_tipuses', function (Blueprint $table) {
            $table->id('ID');
            $table->string('tipus',10);
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
        Schema::dropIfExists('diaks_szulos');
        Schema::dropIfExists('diaks');
        Schema::dropIfExists('szulos');
        Schema::dropIfExists('tanars');
        Schema::dropIfExists('felh_tipuses');
    }
};
