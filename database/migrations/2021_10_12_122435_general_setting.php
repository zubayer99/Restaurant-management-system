<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class GeneralSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_title');
            $table->string('store_name');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('logo')->nullable();
            $table->string('opening_time');
            $table->string('closing_time');
            $table->string('service_charge')->nullable();
            $table->integer('tax_percent');
            $table->string('curr_format');
            $table->string('copyright_text');
            $table->string('theme_color');
            $table->timestamps();
        });

        DB::table('general_settings')->insert([
            'app_title' => 'Yb Restaurant',
            'store_name' => 'Yb Restaurant',
            'address' => 'New York, US',
            'email' => 'email@email.com',
            'phone' => '1234567895',
            'logo' => 'logo.png',
            'opening_time' => '10:00',
            'closing_time' => '23:00',
            'service_charge' => '0',
            'tax_percent' => '5',
            'curr_format' => '$',
            'copyright_text' => 'Copyright 2023',
            'theme_color' => '#E45118',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_setting');
    }
}
