<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Expectation;
use PHPUnit\Framework\ExpectationFailedException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function register(HttpRequest $request)
    {
        // $firebase_checking_user_flag = FirebaseService::validate_user_using_uid($request->id_token, $request->user_uid, $request->phone);
        //     if ($firebase_checking_user_flag) {
            //return 'ouno';

            try {
                $user = User::create([
                    'email'=>$request->email,
                    'password'=>$request->password,
                    'name'=>$request->name
                 ]);
         
                 $token = $user->createToken('customer-api')->plainTextToken;
         
                 $date['user'] = $user;
                 $date['token'] = $token;
                
                 return response($date) ;
            } catch (\Throwable $th) {
                throw new ExpectationFailedException('error');
            }
               
            // }

             
    }

    public static function login(HttpRequest $request)
    {
       
        if (User::where('email', '=', $request->input('email'))->count() > 0) {
          $admin = User::where('email', $request->email)->first();
      
           
            $token = $admin->createToken('MyApp')->plainTextToken;
    
            if (!$token)
                return false;
                
            $admin->api_token = $token;
            $admin->role_type = "admin";
            return $admin;  
         }
      

        return response('Error' , 404);
    }
}
