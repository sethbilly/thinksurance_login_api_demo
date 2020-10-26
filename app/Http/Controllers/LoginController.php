<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function register(Request $request) {
        try
        {
            $this->validate($request, [
                'email' => 'required|unique:users',
                'password' => 'required',
                'name' => 'required'
            ]);

            $input = array();
            $input['name'] = $request->input('name');
            $input['email'] = $request->input('email');
            $input['password'] = $request->input('password');

            $user = User::create($input);
            return response()->json([
                'status' => 'SUCCESS',
                'user_id' => $user->id
            ], Response::HTTP_OK);
        }catch (\Exception $e)
        {
            return response()->json([
                'status' => 'FAIL',
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if(Hash::check($request->input('password'), $user->password))
        {
            return response()->json([
                'status' => 'SUCCESS',
                'user_id' => $user->id,
                'username' => $user->email,
                "roles" => $user->roles,
                "permissions" => $user->permissions
            ], Response::HTTP_OK);
        }else
        {
          return response()->json([
              'status' => 'FAIL',
              'message' => 'Wrong username or password'
            ],Response::HTTP_UNAUTHORIZED);
        }

    }
}
