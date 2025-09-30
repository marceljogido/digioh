<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\OurWork\Http\Controllers\Frontend', 'as' => 'frontend.', 'middleware' => 'web', 'prefix' => ''], function () {

    /*
     *
     *  Frontend OurWorks Routes
     *
     * ---------------------------------------------------------------------
     */
    $controller = 'OurWorksController';
    Route::get('our-work', ['as' => 'ourwork.index', 'uses' => "$controller@index"]);
    Route::get('our-work/{id}/{slug?}', ['as' => 'ourwork.show', 'uses' => "$controller@show"]);
});

/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\OurWork\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => 'admin'], function () {
    /*
    * These routes need view-backend permission
    * (good if you want to allow more than one group in the backend,
    * then limit the backend features by different roles or permissions)
    *
    * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
    */

    /*
     *
     *  Backend OurWorks Routes
     *
     * ---------------------------------------------------------------------
     */
    $module = 'our-works';
    $controller = 'OurWorksController';
    Route::resource("$module", "$controller");
});
