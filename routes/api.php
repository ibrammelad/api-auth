<?php

use App\Http\Controllers\API\admin\LoginController;
use App\Http\Controllers\API\MaincategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['api', 'checkPassword','changeLanguage'] , 'namespace'=>'API'], function ()
{
   Route::post("getMainCategories" ,[MaincategoryController::class, 'index']);
    Route::post("getMainCategory" ,[MaincategoryController::class, 'getCategoryById']);
    Route::post("changeStatus" ,[MaincategoryController::class, 'changeStatus']);

    Route::group(['namespace' =>'admin', 'prefix'=>'admin'], function ()
    {
        Route::post('login' , [LoginController::class ,'login']);
    });





});

Route::group(['middleware' => ['api', 'checkPassword','changeLanguage' , 'checkAdminToken:Admin-api'] , 'namespace'=>'API'], function ()
{


});
