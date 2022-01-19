<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccessController extends Controller
{
    public function register(Request $request)
    {
      $fields = $request->validate([
          'name'=>'required|string|max:255',
          'email'=>'required|email|max:255|unique:users',
          'password'=>'required|string|min:8|confirmed'
      ]);

        try {
            /*
         * Create the Admin user
         */
            $user = User::create([
                'name'=>$fields['name'],
                'email'=>$fields['email'],
                'password'=>Hash::make($fields['password'])
            ]);
            /*
             * Create an access token for this admin user
             */
            $token = $user->createToken('oxymoron')->plainTextToken;
            return (new UserResource(User::find($user->id)))->additional(['meta'=>['token'=>$token]]);
        }catch (QueryException $exception){
            return response(['message'=>'Ooops!!!, something went wrong'],400);
        }
    }

    public function login(Request $request)
    {
        $fields =  $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        try {
            /*
           * Check to see if user's email exist
           * in the database
           */
            $user = User::where('email', $fields['email'])->first();
            if(!$user || !Hash::check($fields['password'], $user->password)){
                return response([
                    'message'=>'Bad Credentials',
                ], 422);
            }
            /*
             * create access token for the admin user
             */
            $token = $user->createToken('oxymoron')->plainTextToken;
            return (new UserResource(User::find($user->id)))->additional(['meta'=>['token'=>$token]]);
        }catch (QueryException $exception){
            return response(['message'=>'something went wrong'], 400);
        }
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(['message'=>'logged out'], 200) ;
    }

}
