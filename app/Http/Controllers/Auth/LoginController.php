<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Traits\Response;


class LoginController extends Controller
{
    use Response;

    public function register(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response(['user' => $user, 'token' => $token]);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Invalid inputs', 422, $validator->errors());
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->errorResponse('.Unauthorized', 401);
        }

        $user = Auth::user();
        $token = $user->createToken('API Token')->accessToken;

        return $this->successResponse([
            'access_token' => $token,
            'user' => $user
        ], 'Login successfuly');
    }
    public function logout(Request $request)
    {
        try {
            if (!$request->user()) {
                return $this->errorResponse('Unauthorized', 401);
            }

            $request->user()->token()->revoke();

            return
                $this->successResponse([], 'User logged out successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('An error occurred during logout.', 500);
        }
    }
}