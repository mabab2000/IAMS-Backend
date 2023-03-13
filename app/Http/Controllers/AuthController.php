<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('access-token')->plainTextToken;
            $user_id = $user->id;
            $dep_id = $user->dep_id;
            $first_name = $user->first_name;
            $last_name = $user->last_name;
            $role = DB::table('role_user')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('role_user.user_id', $user_id)
            ->select('roles.name')
            ->first();

$role_name = ($role) ? $role->name : null;


            return response()->json([
                'message' => 'Login sucessfully',
                'role' => $role_name,
                'token' => $token,
                'id' => $user_id,
                'department' => $dep_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'redirect_url' => 'http://localhost:3000/User',
                'redirect_url_department' => 'http://localhost:3000/Department',
                'redirect_url_reception' => 'http://localhost:3000/Reception',
                'redirect_url_admin' => 'http://localhost:3000/admin',
            ], 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout successfully']);
    }
}