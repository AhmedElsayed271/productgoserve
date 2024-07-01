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
        Schema::create('activity_log', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            
            $table->bigInteger('subject_id')->nullable();
            $table->string('subject_type')->nullable();
            $table->string('description')->nullable();

            $table->bigInteger('causer_id')->nullable();
            $table->string('causer_type')->nullable();

            $table->string('properties')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
