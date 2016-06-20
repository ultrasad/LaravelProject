<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSocial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialpost', function (Blueprint $table) {
            $table->increments('id');
            $table->string('social', 60);
            $table->integer('event_id')->unsigned()->index();
            $table->string('page_id', 60)->nullable();
            $table->string('post_id', 60)->nullable();
            $table->date('published_at')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('event_id')->references('id')
                  ->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_social');
    }
}
