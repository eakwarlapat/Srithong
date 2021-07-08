<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cus_name');
            $table->string('cus_surname');
            $table->string('cus_tel');
            $table->string('cus_email');
            $table->string('cus_add');
            $table->string('personalid');
            $table->unsignedTinyInteger('rent_status');

            $table->unsignedBigInteger('rooms_id')->nullable()->index();
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
        Schema::dropIfExists('customers');
    }
}
