<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventsAddDetailSlugBrief extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('url_slug', 100)->unique()->nullable();
            $table->string('brief')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('start_datetime');
            $table->timestamp('end_datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['url_slug', 'brief', 'image', 'start_datetime', 'end_datetime']);
        });
    }
}
