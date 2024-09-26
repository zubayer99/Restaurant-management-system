<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KitchenSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitchen_setting', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('password');
            $table->boolean('status')->default('1');
            $table->timestamps();
        });

        DB::table('kitchen_setting')->insert([
            'username' => 'admin',
            'password' => Hash::make('123456'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kitchen_setting');
    }
}
