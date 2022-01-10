<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('settings');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->boolean('category_public')->default(0);
            $table->boolean('subcategory_public')->default(0);
            $table->boolean('page_public')->default(0);
            $table->boolean('page_open_in_new_window')->default(1);
        });
    }
}
