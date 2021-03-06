<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social', function (Blueprint $table) {
            $table->increments('id');
            $table->string('social', 60);
            $table->string('social_id');
            $table->string('name');
            $table->string('token')->nullable();
            $table->string('long_live_token')->nullable();
            $table->string('page_token')->nullable();
            $table->timestamps();
        });

        Schema::create('brand_social', function (Blueprint $table) {
            $table->integer('brand_id')->unsigned()->index();
            $table->foreign('brand_id')->references('id')
                  ->on('brand')->onDelete('cascade');

            $table->integer('social_id')->unsigned()->index();
            $table->foreign('social_id')->references('id')
                  ->on('social')->onDelete('cascade');

            $table->timestamps();
        });

        /*Schema::create('brand_social', function (Blueprint $table) {
            $table->integer('brand_id')->unsigned()->index();
            $table->foreign('brand_id')->references('id')
                  ->on('brand')->onDelete('cascade');

            $table->integer('social_id')->unsigned()->index();
            $table->foreign('social_id')->references('id')
                  ->on('social')->onDelete('cascade');

            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop('social');
        //Schema::drop('brand_social');
    }
}
