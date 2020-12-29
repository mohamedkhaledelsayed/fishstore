<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class APIRegisterController extends Controller
{
    
    
    public function register(Request $request)
    {

    

   
        $rules= [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'device_token'=>'required',
            'device_type'=>'required',

        ];
       $request->validate($rules);

      
        User::create([
            'name' => $request->firstname . " ", $request->lastname,
            'email' => $request->email,
            'phone_number'=>$request->phone_number,
            'password' => bcrypt($request->password), 
            'device_token'=>$request->device_token,
            'device_type'=>$request->device_type
            
          
        ]);

   
        $users =User::select('id','name','email','phone_number')->get();
        foreach($users as $user){
         
            $token = JWTAuth::fromUser($user);
    
        }
        

        $status=true; 

        $massage= __('auth.register');
        $data=['token'=>$token,'user'=>$user];
        return response()->json(['status'=> $status,'massage'=>$massage,'data'=>$data]);
    }
}
