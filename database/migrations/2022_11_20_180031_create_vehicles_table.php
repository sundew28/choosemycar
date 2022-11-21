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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle_id')->nullable();
            $table->string('status')->nullable();
            $table->string('mark')->nullable();
            $table->string('colour')->nullable();
            $table->string('fuel')->nullable();
            $table->string('vehicle_dealer_id')->nullable();
            $table->foreign('vehicle_dealer_id')->references('dealer_id')->on('dealers');
            $table->string('images')->nullable();            
            $table->softDeletes();            
            $table->timestamps();
            $table->index(['deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
};
