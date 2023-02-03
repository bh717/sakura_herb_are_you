<?php

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
 **/


Route::group(['prefix' => 'v1'], function () {
    // 認証なし
    Route::post('auth/login', 'Api\User\AuthController@login');
    Route::post('auth/regist', 'Api\User\AuthController@regist');
    Route::post('auth/reset-password-url', 'Api\User\AuthController@resetPasswordUrl');
    Route::post('auth/reset-password', 'Api\User\AuthController@resetPassword');
    // 認証あり
    Route::middleware(['multiauth:api',])->get('auth/getMyData', 'Api\User\AuthController@getMyData');
    Route::middleware(['multiauth:api',])->put('auth/update', 'Api\User\AuthController@update');
    // Route::middleware([])->post('auth/update/image', 'Api\User\AuthController@image');
    Route::middleware(['multiauth:api',])->get('user-delivery-locations', 'Api\User\UserDeliveryLocationController@show');
    Route::middleware(['multiauth:api',])->put('user-delivery-locations', 'Api\User\UserDeliveryLocationController@update');

    Route::get('loginName/getNameByEmail/{email}', 'Api\User\EmailController@getName');
    Route::get('detailedsymptoms/symptoms/{id}', 'Api\User\DetailedSymptomsController@symptoms');
    Route::get('detailedflavors/flavors/{id}', 'Api\User\DetailedFlavorsController@flavors');
    Route::get('detailedtastes/tastes/{id}', 'Api\User\DetailedTastesController@tastes');


    Route::get('detailedsymptomsproduct/symptoms/{name}/{id}', 'Api\User\DetailedSymptomsProductController@symptoms');
    Route::get('symptomproduct/product/{id}', 'Api\User\SymptomProductController@product');


    Route::middleware([])->get('products/categories', 'Api\User\ProductController@categories');
    Route::middleware([])->resource('products', 'Api\User\ProductController');

    Route::middleware([])->get('trialproducts/categories', 'Api\User\TrialProductController@categories');
    Route::get('trialproducts/kind/{id}', 'Api\User\TrialProductController@getKind');
    Route::get('trialproducts/subitem/{id}', 'Api\User\TrialProductController@getSubItem');


    Route::middleware([])->resource('trialproducts', 'Api\User\TrialProductController');



    Route::middleware(['multiauth:api',])->post('order/confirm', 'Api\User\OrderController@confirm');
    Route::middleware(['multiauth:api',])->get('orders/getDeliveredAtList', 'Api\User\OrderController@getDeliveredAtList');
    Route::middleware(['multiauth:api',])->resource('orders', 'Api\User\OrderController');
    Route::middleware(['multiauth:api',])->resource('order-details', 'Api\User\OrderDetailController');
    Route::post('carts/mine', 'Api\User\CartController@mine');

    Route::post('coupons/effectiveness', 'Api\User\CouponController@effectiveness');

    Route::resource('inquiries', 'Api\User\InquiryController');
    Route::resource('therapist-blogs', 'Api\User\TherapistBlogController');

    Route::get('contents/firstContent/{kind}', 'Api\User\ContentController@firstContent');
    Route::get('contents/about', 'Api\User\ContentController@indexAbout');

    Route::resource('faq-categories', 'Api\User\FaqCategoryController');
});
