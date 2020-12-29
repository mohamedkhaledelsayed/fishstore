<?php

use Illuminate\Http\Request;
use App\User;


     
        function sendNotification($title,$body,$token = null,$product=null)
        {
            $firebaseToken = [$token];
            if(!$token) {
                $firebaseToken = User::whereNotNull('device_token')->get()->pluck('device_token');
            }
            
            
            $SERVER_API_KEY = 'AAAAJTroweU:APA91bEh0-lLWxy9DYIRxAu_YhyYnp7i-j6fCYAWTbUAQ6X3ZJNJjQb9pBdJkZ6AK5vegjc1cbHB5g1L2fW_juzPZCFfFLmoq6HI8wy4ejAIqrZbLYcdLSge9o_-Ls45kMT7rkFBq5bF';
            $data = [
                "registration_ids" => $firebaseToken,
                "notification" => [
                    "title" => $title,
                    "body" => $body,  
                    "product_id"=>$product
                ],
                "data" => [
                    "title" => $title,
                    "body" => $body, 
                    "product_id"=>$product,
                    "click_action" => "FISH_ACTION"
                    
                ],
            ];
            
            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];

            

            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                
            $response = curl_exec($ch);
            

        }

        if (!function_exists('admin')) {
            function admin($url = '')
            {
                return url('/dashboard') . '/' . $url;
            }
        }
        if (!function_exists('default_lat_lon')) {
            function default_lat_lon()
            {
                return [
                    'lat' => 29.4264420184,
                    'lon' => 47.8585050625,
                ];
            }
        }
        if (!function_exists('get_image_path')) {
            function get_image_path($image)
            {
              if(config('app.env') == 'production') {
                    return asset('public/uploads/'.$image);
              }
              return asset('uploads/'.$image);

            }
        }



?>