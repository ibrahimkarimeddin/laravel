<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class Cach extends Controller
{
     public function test(){

        $caching = Cache::get('users');
        
        if($caching){
           
            return 'caching' . $caching; 
        }else{
            Cache::set('users', User::all() , 30);
            return 'Nooooo' . $caching;
        }
        // $users  = User::all();
        // return $users;
     }
}
