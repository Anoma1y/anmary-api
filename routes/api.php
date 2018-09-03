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

    // File
    Route::post('/image', 'Image\ImageController@POST_Image');
    Route::get('/image/{image_id}', 'Image\ImageController@GET_ImageSingle');

    // Category
    Route::get('/category', 'Category\CategoryController@GET_Category');
    Route::post('/category', 'Category\CategoryController@POST_Category');
    Route::patch('/category/{category_id}', 'Category\CategoryController@PATCH_CategorySingle');

    // Brand
    Route::get('/brand', 'Brand\BrandController@GET_Brand');
    Route::post('/brand', 'Brand\BrandController@POST_Brand');
    Route::patch('/brand/{brand_id}', 'Brand\BrandController@PATCH_BrandSingle');

    // Season
    Route::get('/season', 'Season\SeasonController@GET_Season');
    Route::post('/season', 'Season\SeasonController@POST_Season');
    Route::patch('/season/{season_id}', 'Season\SeasonController@PATCH_SeasonSingle');

});
