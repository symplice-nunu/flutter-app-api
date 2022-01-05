<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Validator;

class AuthController extends Controller
{
//     public function register(Request $request) {
//   $validatedData = $request->validate([
//     'name' => 'required|max:55',
//     'role' => 'required|max:55',
//     'email' => 'email|required|unique:users',
//     'password' => 'required|confirmed'
//   ]);

//   $validatedData['password'] = bcrypt($request->password);
//   $user = User::create($validatedData);
//   $accessToken = $user->createToken('authToken')->accessToken;

//   return response([ 'user' => $user, 'access_token' => $accessToken]);
// }

public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

public function login(Request $request) {
 
  $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $input = $request->only('email','password');
                
  
  if (!auth()->attempt($input)) {
    return response(['message' => 'Invalid Email and Password']);
  }
 
  $accessToken = auth()->user()->createToken('authToken')->accessToken;
  return response(['user' => auth()->user(), 'access_token' => $accessToken]);
}

public function logout(Request $request) {
  $request->user()->token()->revoke();
  return response()->json([
    'message' => 'Successfully logged out'
  ]);
}

public function user(Request $request) {
  return response()->json($request->user());
}
}