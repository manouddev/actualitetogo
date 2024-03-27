<?php
namespace App\Http\Controllers\Api\Web\Authentication;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'submitLogin' ,'register']]);
    }

    public function me()
    {
        $user = User::select('users.prenoms', 'users.email','users.username', 'roles.name as role_name')
        ->where('users.id', auth()->user()->id)
        ->where('users.status', 1)
        ->where('users.visible', 1)
        ->where('roles.visible', 1)
        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
        ->first();
        return response()->json([
            'status' => 200,
            'user' => $user
        ]);
    }

    public function getRole()
    {
        $role = Role::where('visible', 1)->where('id', auth()->user()->role_id )->first();

        return response()->json([
            'status' => 200,
            'role' => $role->nbRsp
        ], 200);
    }
}
