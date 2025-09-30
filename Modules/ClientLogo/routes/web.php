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

// Frontend: not needed; logos consumed on homepage

/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\ClientLogo\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => 'admin'], function () {
    $name = 'clientlogos';
    $path = 'client-logos';
    $controller = 'ClientLogosController';

    Route::get("$path/index_list", ['as' => "$name.index_list", 'uses' => "$controller@index_list"]);
    Route::get("$path/index_data", ['as' => "$name.index_data", 'uses' => "$controller@index_data"]);
    Route::get("$path/trashed", ['as' => "$name.trashed", 'uses' => "$controller@trashed"]);
    Route::patch("$path/trashed/{id}", ['as' => "$name.restore", 'uses' => "$controller@restore"]);
    Route::resource($path, $controller)->names($name);
});
