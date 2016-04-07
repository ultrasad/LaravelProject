<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('logo_image')->nullable();
            $table->string('logo_cover')->nullable();
            $table->string('slogan')->nullable();
            $table->text('detail')->nullable();
            $table->string('category')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('line_officail')->nullable();
            $table->string('youtube')->nullable();
            $table->enum('approve_status', ['Y', 'N'])->default('N');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop('brand');
    }
}
