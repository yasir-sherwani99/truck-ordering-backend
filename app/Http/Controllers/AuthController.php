<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Http\Requests\UserStoreRequest;
// use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function register(UserStoreRequest $request)
    {
        $user = new User();
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        // authenticate user
        Auth::attempt($request->only('email', 'password'));
        $token = $user->createToken('truckUserToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Well-done! You are loggedin successfully',
            'accessToken' => $token
        ], 200);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|exists:users,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

         // attempt to log the user in using email and password
        if(Auth::attempt($request->only('email', 'password'))) {
            
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('truckUserToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Well-done! You are loggedin successfully',
                'accessToken' => $token,
                'user' => $user
            ], 200);
        } else {
             // if authentication fails, add a custom validation error
            $validator->errors()->add('credentials', 'Invalid login credentials.');

            // return the validation error with the custom message
            return response()->json(['errors' => $validator->errors()], 422);
        }
    }

    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'You are logged out successfully'
        ], 200);
    }
}
