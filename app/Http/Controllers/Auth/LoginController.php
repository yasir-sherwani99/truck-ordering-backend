<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest')->except('logout');
       // $this->middleware('auth')->only('logout');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!isset($user) || empty($user)) {
            return response()->json([
                'success' => false,
                'message' => 'Woops! No account associated with this email'
            ], 404);
        }

        if(Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Woops! Invalid login credentials. Please try again'
            ], 401);
        }

        $token = $user->createToken('truckUserToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Well-done! You are loggedin successfully',
            'accessToken' => $token
        ], 200);
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
