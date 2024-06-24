<?php
namespace App\Http\Controllers\Api\Web\Authentication;
use App\Http\Controllers\Api\BaseController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Routing\Controllers\Middleware;

class ProfileController extends BaseController
{

    public static function middleware(): array{

        return [
            new Middleware(middleware: 'auth:api', except: ['login', 'submitLogin', 'register', 'sendOtpRegister', 'checkOtpRegister', 'newInfoRegister', 'newPassRegister', 'forgot_password', 'sendOtpForgotPassword', 'checkOtpForgotPassword', ' newPassForgotPassword']),
        ];

    }

    public function me()
    {
        $user = User::select('users.prenoms', 'users.email','users.username', 'roles.name as role_name')
        ->where('users.id', auth()->user()->id)
        ->where('users.status', 1)
        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
        ->first();
        return response()->json([
            'status' => 200,
            'user' => $user
        ]);
    }

    public function getRole()
    {
        $role = Role::where('id', '=' ,auth()->user()->role_id )->first();

        return response()->json([
            'status' => 200,
            'role' => $role->nbRsp
        ], 200);
    }
}
