<?php

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

Route::group([
    'prefix' => 'v1',
    'middleware' => ['api']
], function () {

    Route::get('/category', 'Category\CategoryController@GET_Category');
    Route::post('/category', 'Category\CategoryController@POST_Category');
    Route::patch('/category/{category_id}', 'Category\CategoryController@PATCH_CategorySingle');

});
