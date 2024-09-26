<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManageFood extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_food', function (Blueprint $table) {
            $table->id("food_id");
            $table->string('food_name');
            $table->string('category');
            $table->string('Kitchen');
            $table->string('menu_type');
            $table->string('description')->nullable();
            $table->string('image');
            $table->string('cooking_time');
            $table->string('price');
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('manage_food');
    }
}
