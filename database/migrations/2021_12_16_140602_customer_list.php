<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CustomerList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_list', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('customer_name');
            $table->string('email',250)->nullable();
            $table->string('password')->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('created_by');
            $table->timestamps();
        });

        DB::table('customer_list')->insert([
            'customer_name' => 'Walk In',
            'phone' => '9999999999',
            'created_by' => 'admin',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_list');
    }
}
