<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:8'
        ]);
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if (isset($user)) {
            // this user email is exists
            // checking password
            if (Hash::check($password, $user->password)) {
                // both password is the same 
                // generate token
                $token = $user->createToken($user->email . '#store')->plainTextToken;
                // return [ user , token ]
                return response()->json([
                    'user' => $user,
                    'token' => $token
                ], 200);
            } else {
                // this provided password is not the same in our database
                // throw error | exception
                return response()->json([
                    'errors' => [
                        'password' => 'هذه كلمة السر لا تتوافق مع بياناتنا'
                    ]
                ], 422);
            }
        } else {
            // this email is not exists in our database
            // throw error | exception
            return response()->json([
                'errors' => [
                    'email' => "هذا البريد الالكتروني غير موجود"
                ]
            ], 422);
        }
    }
}
