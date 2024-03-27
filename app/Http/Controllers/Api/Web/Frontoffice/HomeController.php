<?php
namespace App\Http\Controllers\Api\Web\Frontoffice;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tags;
use App\Models\Category;
use App\Models\Publication;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function home(){

        $articles_count = Publication::where('visible', 1)->where('status', 1)->count();

        if($articles_count === 0){

            return view('errors.HomePageControlEmpty');

        }else{

            return view('welcome');
        }
    }

}
