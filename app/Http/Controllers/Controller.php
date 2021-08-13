<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Identify the ip address from the requested data
     * @param request is the requested object
     * @returns the ip address of the requester
     */
    public function getUserIP(Request $request){
        try
        {
            $user_ip_address = $request->ip();
            $name = $request['name'];
            if(!empty($user_ip_address) && isset($user_ip_address)){
                $data = array();
                $data['ip'] = $user_ip_address;
                if(!empty($name) && isset($name)){
                    $data['greeting'] = $name;
                }
                return $this->createResp(200, $data);
            }
            return $this->createResp(400, [], 'No IP found');
        }
        catch (\Throwable $th)
        {
            Log::error("Error in getting user ip ".$th->getMessage());
            return $this->createResp(500, [], $th->getMessage());
        }
        
    }
    
    /**
     * Prepare the json response with status code and ip
     * @param http_code this is the status code 
     * @param data is th actual IP address of the requester 
     * @returns complete response in json format
     */
    public function createResp($http_code = 200, $data = [], $error_message = 'Something went wrong')
    {
        if($http_code != 200){
            $data['error'] = $error_message;
        }
        $resp = response()->json($data, $http_code, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $resp->header('Content-Type','application/json; charset=utf-8');
        $resp->header('x-hello-world', env('X_HELLO_WORLD', 'PV'));

        return $resp;
    }
}
