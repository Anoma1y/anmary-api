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

    // Product
    Route::post('/product', 'Product\ProductController@POST_Product');
    Route::get('/product', 'Product\ProductController@GET_Product');
    Route::get('/product/v1', 'Product\ProductController@GET_ProductV1');
    Route::get('/product/{product_id}', 'Product\ProductController@GET_ProductSingle');
    Route::patch('/product/{product_id}', 'Product\ProductController@PATCH_ProductSingle');

    // Image
    Route::post('/image', 'Image\ImageController@POST_Image');
    Route::post('/image/{image_id}', 'Image\ImageController@POST_ImageSetDefault');
    Route::post('/image/{image_id_old}/{image_id_new}', 'Image\ImageController@POST_ImageChangeDefault');
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

    // News
    Route::get('/news', 'News\NewsController@GET_News');
    Route::get('/news/{news_id}', 'News\NewsController@GET_NewsSingle');
    Route::post('/news', 'News\NewsController@POST_News');
    Route::patch('/news/{news_id}', 'News\NewsController@PATCH_NewsSingle');

    // Composition
    Route::get('/composition', 'Composition\CompositionController@GET_Composition');
    Route::post('/composition', 'Composition\CompositionController@POST_Composition');
    Route::patch('/composition/{composition_id}', 'Composition\CompositionController@PATCH_CompositionSingle');

    Route::post('/compound', 'Compounds\CompoundsController@POST_Compounds');

    // Composition
    Route::get('/size', 'Size\SizeController@GET_Size');

    Route::post('/proportion', 'Proportions\ProportionsController@POST_Proportions');

    // Roles
    Route::get('/role/schema', 'Role\RoleController@GET_RoleSchema');
    Route::post('/role', 'Role\RoleController@POST_Role');
    Route::get('/role', 'Role\RoleController@GET_Role');
    Route::get('/role/{role_id}', 'Role\RoleController@GET_RoleSingle');
    Route::patch('/role/{role_id}', 'Role\RoleController@PATCH_RoleSingle');

    // Me
    Route::get('/me', 'Me\MeController@GET_Me');

    // Session
    Route::post('/session', 'Session\SessionController@POST_Session');
    Route::get('/session/refresh', 'Session\SessionController@GET_SessionRefresh');
    Route::delete('/session', 'Session\SessionController@DELETE_Session');

    // User
    Route::post('/user', 'User\UserController@POST_User');
    Route::patch('/user/{user_id}', 'User\UserController@PATCH_UserSingle');
    Route::get('/user/schema', 'User\UserController@GET_UserSchema');
    Route::get('/user/{user_id}', 'User\UserController@GET_UserSingle');
    Route::get('/user', 'User\UserController@GET_User');

    // Subscribe
    Route::post('/subscribe', 'Subscribe\SubscribeController@POST_Subscribe');

});
