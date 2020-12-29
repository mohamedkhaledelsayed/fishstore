<?php


namespace App\Http\Controllers\Auth\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class PasswordResetRequestController extends Controller {
  
    public function sendPasswordResetEmail(Request $request){
        // If email does not exist
        if(!$this->validEmail($request->email)) {
            return response()->json([
                'message' => 'Email does not exist.'
            ], Response::HTTP_NOT_FOUND);
        } else {
     
                // If email exists
                $user=User::where('email',$request->email)->first();
                $user->forgetpasswordCode=rand(1111,9999);
                $user->save();
                $this->sendMail($request->email);
                return response()->json([
                    'message' => 'Check your inbox, we have sent a link to reset email.'
                ], Response::HTTP_OK);            
            }
        }


        public function sendMail($email){
            $token = $this->generateToken($email);
            $user=User::where('email',$email)->first();
            $codev=$user->forgetpasswordCode;
            Mail::to($email)->send(new SendMail($token,$codev));
        }

        public function validEmail($email) {
        return !!User::where('email', $email)->first();
        }

        public function generateToken($email){
        $isOtherToken = DB::table('password_resets')->where('email', $email)->first();

        if($isOtherToken) {
            return $isOtherToken->token;
        }

        $token = Str::random(80);;
        $this->storeToken($token, $email);
        return $token;
        }

        public function storeToken($token, $email){
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()            
            ]);
        }

        public function verifycode(Request $request)
        {
            $user= User::where('forgetpasswordCode',$request->verifycode)->first();
            if (!$user) {
                return response()->json(['Error'=>'This confirmation code is wrong'],500);       
            }else{
                return response()->json(['verifycode'=>true],200); 
            }
            
        }

    public function change_password(Request $request)
    {
        $input = $request->all();
        $userid = Auth::user()->id;

        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $request->validate($rules);
       
      
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    return response()->json(["status" => false, "message" => __('passwords.oldpassword')],422);
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    return response()->json(["status" => false, "message" => __('passwords.currentpassword')],422);
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    return response()->json(["status" => true, "message" => __('passwords.updatepassword')],200);
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                return response()->json(["status" => false, "message" => $msg],422);
            }
        }
        
    
        public function editprofile(Request $request)
        {
            $userid=$request->user()->id;
            $profile =User::findOrfail($userid);

            $request->validate([
                'name'=>'required',
                'phone_number'=>'required'
            ]);

            $profile->update([
                'name'=>$request->name,
                'phone_number'=>$request->phone_number	
            ]);
              
            $data=$profile->only('name','phone_number');
            return response()->json(["status"=> true,'message'=>__('passwords.Profile'),'data'=>$data]);

        }



        public function changepassword(Request $request)
        {
            $input = $request->all();
            $email=$request->email;
            $rules = array(
                'email' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            );
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                 return response()->json(["message" => $validator->errors()->first()],400);
            } else {
                try {
                    $emailuser=User::where('email',$email )->first();
                    if ($emailuser ) {
                        $emailuser->update(['password' => Hash::make($input['new_password'])]);
                        return response()->json([ "message" =>__('passwords.updatepassword')],200);
        
                     } else {
                        return response()->json(["message" =>__('passwords.sent')],500);
        
                    }
                } catch (\Exception $ex) {
                    if (isset($ex->errorInfo[2])) {
                        $msg = $ex->errorInfo[2];
                    } else {
                        $msg = $ex->getMessage();
                    }
                     return response()->json([ "message" => $msg],400);
                }
            }
         }

}