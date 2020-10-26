<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public function permissions()
    {
        return Permission::all()->paginate(100);
    }


    public function roles()
    {
        return Role::all()->paginate(100);
    }

    public function rolesAddUser(Request $request)
    {
        try
        {
            $user = User::findOrFail($request->get('user_id'));
            $role = Role::where('name', $request->get('role'))->first();
            $user->roles()->attach($role);
            return response()->json([
                'status' => 'SUCCESS',
                'message' => $role->name . " Role successfully assigned to User!"
            ], Response::HTTP_OK);
        }catch(\Exception $e)
        {
            return response()->json([
                'status' => 'FAIL',
                'message' => $e->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }


    }

}
