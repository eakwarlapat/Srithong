<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('month');
            $table->unsignedTinyInteger('status');
            $table->unsignedInteger('internet');
            $table->unsignedInteger('electric');
            $table->unsignedInteger('water');
            $table->unsignedInteger('room_price');

            $table->unsignedBigInteger('rooms_id')->index();
            $table->foreign('rooms_id')->references('id')->on('rooms'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
