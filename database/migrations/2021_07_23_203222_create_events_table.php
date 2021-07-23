<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('venue_id')->foreign()->references('id')->on('venues');
	        $table->string('eventName');
	        $table->string('slug');
	        $table->string('eventPhoto');
	        $table->date('eventDate');
	        $table->time('eventTimeStart');
	        $table->time('eventTimeEnd');
	        $table->string('eventType');
	        $table->string('eventCost');
	        $table->integer('is_live')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
