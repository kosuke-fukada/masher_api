<?php

use App\Http\Inquiry\PostInquiry\PostInquiryAction;
use Illuminate\Support\Facades\Route;
use App\Http\User\Signout\SignoutAction;
use App\Http\Tweet\GetTweet\GetTweetAction;
use App\Http\User\GetUserInfo\GetUserInfoAction;
use App\Http\Like\CreateLikeCount\CreateLikeCountAction;
use App\Http\Like\GetLikeCount\GetLikeCountAction;
use App\Http\Like\GetLikeList\GetLikeListAction;
use App\Http\Like\UpdateLikeCount\UpdateLikeCountAction;
use App\Http\Middleware\VerifyTwitterAccessTokenExpired;
use App\Http\User\SigninWithTwitter\SigninWithTwitterAction;
use App\Http\Tweet\GetTwitterLikeList\GetTwitterLikeListAction;
use App\Http\User\GetTwitterRedirectUrl\GetTwitterRedirectUrlAction;
use App\Http\User\GetTwitterUser\GetTwitterUserAction;
use App\Http\User\RefreshTwitterAccessToken\RefreshTwitterAccessTokenAction;
use App\Http\User\SigninWithRememberToken\SigninWithRememberTokenAction;

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

Route::prefix('signin')->group(function() {
    Route::prefix('twitter')->group(function() {
        Route::get('/', GetTwitterRedirectUrlAction::class);
        Route::get('/callback', SigninWithTwitterAction::class);
    });
    Route::get('/remember_token', SigninWithRememberTokenAction::class)
        ->middleware(VerifyTwitterAccessTokenExpired::class);
});

Route::get('/signout', SignoutAction::class);

Route::prefix('user')->middleware(VerifyTwitterAccessTokenExpired::class)
    ->group(function() {
        Route::get('/', GetUserInfoAction::class);
        Route::get('/twitter', GetTwitterUserAction::class);
        Route::get('/refresh/twitter', RefreshTwitterAccessTokenAction::class);
    });

Route::prefix('likes')->group(function() {
    Route::get('/', GetLikeListAction::class);
    Route::prefix('twitter')->middleware(VerifyTwitterAccessTokenExpired::class)
        ->group(function() {
            Route::get('/', GetTwitterLikeListAction::class);
        });
});

Route::get('/tweet', GetTweetAction::class);

Route::prefix('like_count')->group(function() {
    Route::get('/', GetLikeCountAction::class);
    Route::post('/', CreateLikeCountAction::class);
    Route::put('/', UpdateLikeCountAction::class);
});

Route::post('/inquiry', PostInquiryAction::class);
