<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Pages extends Migration
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
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->boolean('show_in_header');
            $table->boolean('show_in_footer');
            $table->boolean('status')->default('1');
            $table->timestamps();
        });

        DB::table('pages')->insert([
            'title' => 'About',
            'slug' => 'about',
            'content' => '&lt;p&gt;dsfds fsdsd sd sdfs df fsdf sf dsfsdf sdf dsfsd fsdf sdf sdfsd fsdf sf sdfsd fsr etwe ew we rtytujmns fdgshghgs&lt;/p&gt;',
            'show_in_header' => '1',
            'show_in_footer' => '1',
        ]);

        DB::table('pages')->insert([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'content' => '&lt;p&gt;dsfds fsdsd sd sdfs df fsdf sf dsfsdf sdf dsfsd fsdf sdf sdfsd fsdf sf sdfsd fsr etwe ew we rtytujmns fdgshghgs&lt;/p&gt;',
            'show_in_header' => '0',
            'show_in_footer' => '1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waiters');
    }
}
