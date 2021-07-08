<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedTinyInteger('date');
            $table->unsignedTinyInteger('status');
            $table->unsignedInteger('electric');
            $table->unsignedInteger('water');

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
        Schema::dropIfExists('receipts');
    }
}
