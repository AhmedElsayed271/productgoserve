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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1->active, 0-> un active');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('categories_translations', function(Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->unsignedBigInteger('category_id');
            $table->string('locale')->index();
            $table->string('name');
            $table->timestamps();
        
            $table->unique(['category_id', 'locale']);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
