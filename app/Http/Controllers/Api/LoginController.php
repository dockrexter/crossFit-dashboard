<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request){
        try{
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            $credentials = $request->only('email', 'password');
            if (\Auth::attempt($credentials)) {
                $token = \Auth::user()->createToken('Bearer Token')->plainTextToken;
                $data = [
                    'user'                  => \Auth::user(),
                    'token'                 => $token,
                    'token_type'            => 'Bearer'
                ];
                return ['code'=>'200','message'=>'success','data'=>$data];
            }
            return ['code'=>'404','message'=>'Invalid Credentials!'];
        }
        catch(\Exception | ValidationException $e){
            if($e instanceof ValidationException){
                return ['code'=>'422','errors' => $e->errors()];
            }
            else{
                return ['code'=>'500','error_message'=>$e->getMessage()];
            }
        }
    }
}
