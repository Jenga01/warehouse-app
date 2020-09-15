<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    /**
     * User login
     * @bodyParam  email string required An e-mail of the user
     * @bodyParam  password string required User password
     *
     * @response  {
     *  "status_code": 200,
     *  "access_token": "9|h1kro28YLrZiPakxLQX3KFRX8YN4kHnw0vIuQEteckbAsThSwyYFvlzFYFSjEtjrRp94UUJzJYHLUcmr",
     *  "token_type": "Bearer"
     * }
     */

    public function login(Request $request)
    {
        try {

            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Unauthorized'
                ]);
            }

            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password,[]))
            {
                throw new \Exception('Error logging in');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);
        }
        catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
      'error' => $error,
            ]);
        }
    }
}
