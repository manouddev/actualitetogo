<?php
use App\Http\Controllers\Api\Web\Frontoffice\HomeController; 
use App\Http\Controllers\Api\Web\Frontoffice\OneSlugController; 
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//La route pour la page d'accueil

Route::get('/', [HomeController::class, 'home'] );

//La route pour les pages à lien unique

Route::get('/{slug}', [OneSlugController::class, 'slug']);

Route::get('/tags/{slug}', [OneSlugController::class, 'tags']);

Route::get('/authors/{slug}', [OneSlugController::class, 'authors']);
