<?php


namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use JWTFactory;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Http\Helpers\helper;
class APILoginController extends Controller
{
    public function getuser()
    {
        $user=auth('api')->user();
      
      
        return response()->json(['status'=>true,'data'=>$user]);
    }
    
    public function updateToken(Request $request)
    {
        $validator=[
            'device_token'=>'required',
            'device_type'=>'required',
        ];
        $request->validate( $validator);

      
        auth('api')->user()->update(['device_token'=>$request->device_token,'device_type'=>$request->device_type]);
        $massage=__('auth.updateTokenfirebase');
       return response()->json([ 'status' => true,'massage'=>$massage]);
   }

   
    public function login(Request $request)
    {
        
        
        $validator=  [
            'phone_number'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => 'required',
            'device_token'=>'required',
            'device_type'=>'required'
        ];
        $request->validate($validator);
        $input = $request->only('phone_number','password');

        if($token = auth('api')->attempt($input)) {
            $user =  auth('api')->user();
            $user->id;
            $massage=__('auth.login');
            $data=['token'=>$token,'user'=>$user];
            return response(['status' => true, 'massage'=>$massage,'data'=>$data]);
        }
        return response()->json([
            'status' => false,
            'message' => __('auth.failed'),
        ], 401);
      
    }
    public function logout(Request $request)
    {
       

        $token = $request->header('Authorization');

        try {
            JWTAuth::parseToken()->invalidate($token);
            return response()->json([
                'status' => true,
                'message' => __('auth.logout')
            ],200);
        } catch (JWTException $exception) {
            return response()->json([
                'status' => false,
                'message' => __('auth.errorlogout')
            ], 401);
        }

    }


}
