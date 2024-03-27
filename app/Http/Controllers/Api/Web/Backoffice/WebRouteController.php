<?php

namespace App\Http\Controllers\Api\Web\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebRouteController extends Controller
{
    public function administrateur(){

        return view('backoffice.administrateur');

    }

    public function publicateur(){

        return view('backoffice.publicateur');

    }
}
