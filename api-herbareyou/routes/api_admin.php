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
    // Route::middleware('adminerAuthenticate')->resource('adminers', 'Api\AdminAdminerController')
    //     ->only(config('route.base_only', []))
    //     ->names(config('route.admin_adminers_resource', []));
    Route::post('auth/login', 'Api\Adminer\AuthController@login');
    Route::middleware(['multiauth:admin',])->get('auth/getMyData', 'Api\Adminer\AuthController@getMyData');
    Route::middleware(['multiauth:admin',])->get('auth/logined', 'Api\Adminer\AuthController@logined');
    Route::middleware(['multiauth:admin',])->post('users/mail-magazine', 'Api\Adminer\UserController@mailMagazine');
    Route::middleware(['multiauth:admin',])->resource('users', 'Api\Adminer\UserController');
    Route::middleware(['multiauth:admin',])->resource('products', 'Api\Adminer\ProductController');


    Route::middleware(['multiauth:admin',])->resource('symptoms', 'Api\Adminer\SymptomController');
    Route::middleware(['multiauth:admin',])->resource('flavors', 'Api\Adminer\FlavorController');
    Route::middleware(['multiauth:admin',])->resource('tastes', 'Api\Adminer\TasteController');
    Route::middleware(['multiauth:admin',])->resource('materials', 'Api\Adminer\MaterialController');

    Route::middleware(['multiauth:admin',])->resource('product-categories', 'Api\Adminer\ProductCategoryController');
    Route::middleware(['multiauth:admin',])->resource('product-recommendations', 'Api\Adminer\ProductRecommendationController');

    Route::middleware(['multiauth:admin',])->resource('orders', 'Api\Adminer\OrderController');
    Route::middleware(['multiauth:admin',])->put('orders/{order}/updateDeliveryLocation', 'Api\Adminer\OrderController@updateDeliveryLocation');
    Route::middleware(['multiauth:admin',])->put('orders/{order}/updateStatus', 'Api\Adminer\OrderController@updateStatus');
    Route::middleware(['multiauth:admin',])->post('upload-files/getPreSignedUrl', 'Api\Adminer\UploadFileController@getPreSignedUrl');
    Route::middleware(['multiauth:admin',])->post('upload-files/confirm', 'Api\Adminer\UploadFileController@confirm');

    Route::middleware(['multiauth:admin',])->resource('therapists', 'Api\Adminer\TherapistController');
    Route::middleware(['multiauth:admin',])->resource('therapist-blogs', 'Api\Adminer\TherapistBlogController');

    Route::middleware(['multiauth:admin',])->post('contents', 'Api\Adminer\ContentController@store');
    Route::middleware(['multiauth:admin',])->get('contents/firstContent/{kind}', 'Api\Adminer\ContentController@firstContent');

    Route::middleware(['multiauth:admin',])->resource('faq-categories', 'Api\Adminer\FaqCategoryController');
    Route::middleware(['multiauth:admin',])->resource('faqs', 'Api\Adminer\FaqController');
    Route::middleware(['multiauth:admin',])->resource('coupons', 'Api\Adminer\CouponController');
    Route::middleware(['multiauth:admin',])->resource('users', 'Api\Adminer\UserController');
});
