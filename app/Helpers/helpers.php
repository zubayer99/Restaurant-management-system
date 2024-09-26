<?php
use Illuminate\Support\Facades\DB;


if(! function_exists('pages')){
    function pages(){
        return DB::table('pages')->where('status','1')->get();
    }
}

if(! function_exists('social_links')){
    function social_links(){
        return DB::table('social_links')->first();
    }
}

