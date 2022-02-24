<?php

namespace App\Http\Controllers\Api;

use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    public function register(Request $request){
        try{
            $this->validate($request, [
                'first_name' => ['required', 'string', 'max:255', 'regex:^([a-zA-Z]+(.)?[\s]*)$^'],
                'last_name' => ['required', 'string', 'max:255', 'regex:^([a-zA-Z]+(.)?[\s]*)$^'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'max:20', 'confirmed'],
                'phone_number' => ['required','numeric','digits_between:11,11','unique:users'],
                'dob' => ['required', 'date'],
                'picture' => ['nullable', 'image'],
                'codice_fiscale' => ['nullable', 'mimes:pdf'],
            ]);

            if($request->hasFile('picture')){
                $picture = User::InsertImage($request->file('picture'));
            }

            if($request->hasFile('codice_fiscale')){
                $codice_fiscale = User::InsertCodiceFiscale($request->file('codice_fiscale'));
            }
            
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone_number = $request->phone_number;
            $user->dob = $request->dob;
            $user->picture = !empty($picture) ? $picture : NULL;
            $user->codice_fiscale = !empty($codice_fiscale) ? $codice_fiscale : NULL;
            $user->status = 0;
            $user->save();
            return ['code'=>'200','message'=>'success'];
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
