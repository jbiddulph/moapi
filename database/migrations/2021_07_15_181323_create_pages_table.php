<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->integer('position')->default(0);
            $table->string('title');
            $table->string('linkname');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('content');
            $table->string('image');
            $table->boolean('showServices')->default(false);
            $table->boolean('showAccreditations')->default(false);
            $table->boolean('showCategories')->default(false);
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
        Schema::dropIfExists('pages');
    }
}
