<?php

namespace App\Http\Controllers\Api\Web\Authentication;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'submitLogin' ,'register']]);
    }


    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'vous êtes deconnectés.', 'status' => 200]);
    }

}
