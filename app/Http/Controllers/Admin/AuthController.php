<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;

class AuthController extends Controller
{
    /**
     * Authenticate user
     *
     * @param  array  $data
     * @return [string] token
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|string|exists:admins,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

         // attempt to log the user in using email and password
        if(Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            
            $admin = Admin::where('email', $request->email)->first();
            $token = $admin->createToken('truckAdminToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Well-done! You are loggedin successfully',
                'accessToken' => $token,
                'admin' => $admin
            ], 200);
        } else {
             // if authentication fails, add a custom validation error
            $validator->errors()->add('credentials', 'Invalid login credentials.');

            // return the validation error with the custom message
            return response()->json(['errors' => $validator->errors()], 422);
        }
    }

    /**
     * Logout admin (revoke the token).
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'You are logged out successfully'
        ], 200);
    }

    /**
     * Get the guard to be used during authentication
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard;
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
