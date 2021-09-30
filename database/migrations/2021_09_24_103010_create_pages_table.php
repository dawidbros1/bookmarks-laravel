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
            $table->string('type');
            $table->integer('parent_id');
            $table->string('name', 255);
            $table->string('image_url', 255);
            $table->string('link', 255);
            $table->boolean('public')->default(1);
            $table->boolean('hidden')->default(0);
            $table->boolean('open_in_new_window')->default(1);
            $table->integer('order')->default(1);
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
